# 🚀 CTF Web Platform

Este es un proyecto desarrollado en Laravel que implementa una plataforma de Capture The Flag (CTF) para CIBERSEC-UNASAM. La aplicación permite a los usuarios registrarse, participar en retos y visualizar un ranking basado en su desempeño. Se utiliza Tailwind CSS para el diseño, Jetstream para la autenticación y gestión de usuarios.

## ✨ Características

- 🔐 **Autenticación de usuarios:** Registro e inicio de sesión con Jetstream.
- 🖼️ **Perfil de usuario:** Subida de foto de perfil, edición de información personal.
- 📝 **Registro de datos personales:** Nombres, apellidos, universidad, DNI y nickname.
- 👥 **Usuarios:** Lista de todos los participantes registrados.
- 🎯 **Retos:** Sección donde se muestran los desafíos disponibles.
- 🏆 **Ranking:** Clasificación de usuarios basada en su desempeño en los retos.
- 🎨 **Interfaz moderna:** Estilizada con Tailwind CSS.

## ⚙️ Requisitos

Antes de instalar y ejecutar el proyecto, asegúrate de tener instalados los siguientes requisitos:

- ✅ PHP >= 8.0
- ✅ Composer
- ✅ Node.js y NPM
- ✅ MySQL
- ✅ Laravel 10
- ✅ XAMPP>v.3.3.0 o MySQL WorkBench 8.0
 
## 📥 Instalación

1. Clona el repositorio:
   ```sh
   git clone https://github.com/dpajuelos/cibersec.git
   cd cibersec
   ```

2. Instala las dependencias de PHP:
   ```sh
   composer install
   ```

3. Instala las dependencias de Node.js:
   ```sh
   npm install && npm run dev
   ```

4. Copia el archivo de configuración y genera la clave de la aplicación:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

5. Modifica el archivo .env
   ```sh
   APP_NAME=CibersecUnasam
   APP_URL=http://127.0.0.1:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cibersecunasam
   DB_USERNAME=root
   DB_PASSWORD=
   FILESYSTEM_DISK=public
   ```
   
6. Ejecuta las migraciones para generar las tablas:
   ```sh
   php artisan migrate
   ```

7. Ejecuta los seeders para generar los datos:
   ```sh
   php artisan db:seed
   ```
   
8. Enlace del almacenamiento para visualizar las fotos
   ```sh
   php artisan storage:link
   ```
   
9. Inicia el servidor de desarrollo:
   ```sh
   php artisan serve
   ```
   
## 🚀 Uso

- Accede a la plataforma en `http://127.0.0.1:8000`.
- Regístrate o inicia sesión con tu cuenta.
- Explora los retos y participa en los desafíos.
- Consulta el ranking de usuarios y mejora tu puntuación.

## 🤝 Contribuciones

Si deseas contribuir al proyecto, sigue estos pasos:

1. Realiza un fork del repositorio.
2. Crea una rama para tu nueva característica o corrección de errores.
3. Realiza tus cambios y haz commits descriptivos.
4. Envía un pull request con una descripción detallada de tu aporte.

## 📜 Licencia



