#  Lockers UNET

Sistema web para la gestión de lockers universitarios, enfocado en estudiantes y administradores de la UNET.
Permite administrar usuarios, asignaciones, multas y solicitudes de lockers de manera eficiente.

---

##  Tecnologías utilizadas

*  **Laravel 13** (Backend)
*  **Vue 3 + Inertia.js** (Frontend)
*  **Vite** (Build tool)
*  **MySQL** (Base de datos)
---

##  Características principales

*  Registro y autenticación de usuarios (`@unet.edu.ve`)
*  Sistema de recuperación de contraseña con código por correo
*  Panel de administrador
*  Panel de usuario (estudiante)
*  Gestión de lockers
*  Gestión de multas
*  Notificaciones y solicitudes
* Búsqueda de usuarios por nombre

---

##  Roles del sistema

| Rol     | Descripción                     |
| ------- | ------------------------------- |
| Admin   | Gestión completa del sistema    |
| Usuario | Estudiante con acceso a lockers |

---

##  Instalación del proyecto

### 1. Clonar el repositorio

```bash
git clone https://github.com/LOCKERS-UNET/Lockers-UNET-Back-Front.git
cd Lockers-UNET-Back-Front
```

---

### 2. Instalar dependencias

```bash
composer install
npm install
```

---

### 3. Configurar entorno

Copiar el archivo de entorno:

```bash
cp .env.example .env
```

Generar clave:

```bash
php artisan key:generate
```

---

### 4. Configuración de base de Datos.

Antes de ejecutar el proyecto, es necesario configurar la base de datos.

---

###  MySQL 

1. Crear una base de datos en tu gestor (phpMyAdmin, MySQL Workbench, etc.) llamada:

```text
inertia
```

2. Configurar el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inertia
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Configuración de correo (Recuperación de contraseña)

El sistema utiliza envío de correos para el código de verificación.

### 🔹 Configuración con Gmail

Editar el archivo `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@gmail.com
MAIL_PASSWORD=tu_clave_de_aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_correo@gmail.com
MAIL_FROM_NAME="Lockers UNET"
```

---

### ⚠️ Importante

* No uses tu contraseña personal de Gmail
* Debes generar una **contraseña de aplicación**

---

###  Cómo generar la contraseña de aplicación

1. Activar verificación en dos pasos en tu cuenta de Google
2. Ir a:
   https://myaccount.google.com/apppasswords
3. Crear una nueva contraseña para la aplicación
4. Copiar el código generado (formato):

```text
"xxxx xxxx xxxx xxxx" 
```

5. Usarlo como `MAIL_PASSWORD`

---

### 6. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

---

### 7. Ejecución del proyecto

Abrir dos terminales:

### Backend (Laravel)

```bash
php artisan serve
```

---

### Frontend (Vite)

```bash
npm run dev
```

---

### Acceder en el navegador:

```
http://127.0.0.1:8000
```

---

##  Usuarios de prueba

| Rol     | Email                                         | Contraseña |
| ------- | --------------------------------------------- | ---------- |
| Admin   | [admin@unet.edu.ve](mailto:admin@unet.edu.ve) | Admin123!  |
| Usuario | [juan@unet.edu.ve](mailto:juan@unet.edu.ve)   | Juan123$   |
| Usuario | [maria@unet.edu.ve](mailto:maria@unet.edu.ve) | Maria123%  |

---

## Estructura del proyecto

```
app/                → Lógica backend (controladores, modelos)
routes/             → Definición de rutas
database/           → Migraciones y seeders
resources/js/       → Frontend (Vue)
resources/views/    → Vistas Blade / emails
public/             → Archivos públicos (imágenes)
```

---

##  Recomendaciones

* No subir el archivo `.env`
* Usar ramas (`feature/*`) para nuevas funcionalidades
* Evitar trabajar directamente en `main`
* No usar caracteres especiales en nombres de archivos (`ñ`, acentos)

---

##  Equipo

Proyecto desarrollado por estudiantes de ingeniería en Informática de la UNET.

---

##  Licencia

Este proyecto es de uso académico.

---

##  Autores

- Carvajalino Arturo 
- Sánchez Diego 
- Pinzon Elder 
- Aliendres Douglas 
