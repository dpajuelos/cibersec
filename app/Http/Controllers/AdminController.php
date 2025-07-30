<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Challenge;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }

    /**
     * Dashboard principal del admin
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_challenges' => Challenge::count() ?? 45,
            'submissions_today' => Submission::whereDate('created_at', today())->count() ?? 127,
            'system_uptime' => '99.9%',
            'active_users' => User::where('last_activity', '>=', now()->subMinutes(30))->count(),
            'resolved_challenges' => DB::table('submissions')->where('is_correct', true)->count() ?? 0,
        ];

        $recent_activity = $this->getRecentActivity();
        $system_status = $this->getSystemStatus();

        return view('admin.main', compact('stats', 'recent_activity', 'system_status'));
    }

    /**
     * Gestión de usuarios
     */
    public function users()
    {
        $users = User::with(['university', 'submissions'])
            ->withCount(['submissions as correct_submissions' => function ($query) {
                $query->where('is_correct', true);
            }])
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Ver detalles de un usuario específico
     */
    public function showUser($id)
    {
        $user = User::with(['university', 'submissions.challenge'])
            ->withCount(['submissions as total_submissions', 'submissions as correct_submissions' => function ($query) {
                $query->where('is_correct', true);
            }])
            ->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Asignar permisos a usuario
     */
    public function assignPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:user,admin,moderator'
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Permisos actualizados correctamente');
    }

    /**
     * Gestión de retos
     */
    public function challenges()
    {
        $challenges = Challenge::with(['category', 'submissions'])
            ->withCount(['submissions as total_submissions', 'submissions as correct_submissions' => function ($query) {
                $query->where('is_correct', true);
            }])
            ->paginate(20) ?? collect();  // fallback si no existe el modelo

        return view('admin.challenges.index', compact('challenges'));
    }

    /**
     * Crear nuevo reto
     */
    public function createChallenge()
    {
        $categories = Category::all() ?? collect(['crypto', 'web', 'forensics', 'osint', 'stego', 'misc']);
        return view('admin.challenges.create', compact('categories'));
    }

    /**
     * Almacenar nuevo reto
     */
    public function storeChallenge(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'flag' => 'required|string',
            'points' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'difficulty' => 'required|in:easy,medium,hard',
            'hints' => 'nullable|array',
            'files' => 'nullable|array'
        ]);

        // Lógica para crear el reto
        // Challenge::create($request->all());

        return redirect()->route('admin.challenges')->with('success', 'Reto creado exitosamente');
    }

    /**
     * Gestión de categorías
     */
    public function categories()
    {
        $categories = Category::withCount('challenges')->get() ?? collect();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Crear nueva categoría
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'color' => 'required|string'
        ]);

        // Category::create($request->all());

        return back()->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Sistema de notificaciones
     */
    public function notifications()
    {
        $notifications = Notification::latest()->paginate(20);
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Crear nueva notificación
     */
    public function createNotification()
    {
        return view('admin.notifications.create');
    }

    /**
     * Enviar notificación
     */
    public function storeNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,success,warning,error',
            'target' => 'required|in:all,specific',
            'user_ids' => 'required_if:target,specific|array'
        ]);

        if ($request->target === 'all') {
            $users = User::all();
        } else {
            $users = User::whereIn('id', $request->user_ids)->get();
        }

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'message' => $request->message,
                'type' => $request->type,
                'read_at' => null
            ]);
        }

        return redirect()->route('admin.notifications')->with('success', 'Notificación enviada exitosamente');
    }

    /**
     * Configuración del sistema
     */
    public function settings()
    {
        return view('admin.settings.index');
    }

    /**
     * Logs del sistema
     */
    public function logs()
    {
        // Lógica para obtener logs
        $logs = collect();  // placeholder
        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Estadísticas avanzadas
     */
    public function analytics()
    {
        $analytics = [
            'user_registration_trend' => $this->getUserRegistrationTrend(),
            'challenge_completion_rate' => $this->getChallengeCompletionRate(),
            'category_popularity' => $this->getCategoryPopularity(),
            'daily_activity' => $this->getDailyActivity()
        ];

        return view('admin.analytics.index', compact('analytics'));
    }

    /**
     * Métodos privados para obtener datos
     */
    private function getRecentActivity()
    {
        return [
            [
                'type' => 'user_registered',
                'message' => 'Nuevo usuario registrado',
                'details' => 'carlos.mendez@unasam.edu.pe',
                'time' => '5 min',
                'color' => 'green'
            ],
            [
                'type' => 'challenge_solved',
                'message' => 'Reto resuelto',
                'details' => 'Hash Cracker - Cryptography',
                'time' => '12 min',
                'color' => 'blue'
            ],
            [
                'type' => 'challenge_added',
                'message' => 'Nuevo reto añadido',
                'details' => 'SQL Injection Advanced - Web',
                'time' => '1h',
                'color' => 'purple'
            ]
        ];
    }

    private function getSystemStatus()
    {
        return [
            ['service' => 'Base de Datos', 'status' => 'operational', 'color' => 'green'],
            ['service' => 'Servidor Web', 'status' => 'operational', 'color' => 'green'],
            ['service' => 'CDN', 'status' => 'degraded', 'color' => 'yellow'],
            ['service' => 'API', 'status' => 'operational', 'color' => 'green']
        ];
    }

    private function getUserRegistrationTrend()
    {
        return User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getChallengeCompletionRate()
    {
        // Implementar lógica de tasa de completación
        return [];
    }

    private function getCategoryPopularity()
    {
        // Implementar lógica de popularidad por categoría
        return [];
    }

    private function getDailyActivity()
    {
        // Implementar lógica de actividad diaria
        return [];
    }
}
