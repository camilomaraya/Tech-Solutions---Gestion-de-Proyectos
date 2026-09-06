# Evaluación 3 — API REST de Gestión de Proyectos
## Desarrollo de Software Web I
---
 
Este proyecto corresponde a la **Evaluación 3 de Desarrollo de Software Web I**.

El objetivo de la evaluación es implementar las operaciones CRUD para la gestión de proyectos mediante una API REST desarrollada con Laravel.

La API permite realizar las siguientes operaciones:

- Crear un proyecto.
- Listar todos los proyectos.
- Buscar un proyecto por su ID.
- Actualizar un proyecto existente.
- Eliminar un proyecto.

La implementación utiliza controladores de API, modelos Eloquent, validaciones mediante Form Requests y códigos de respuesta HTTP de acuerdo con los requerimientos de la evaluación.

## Tecnologías utilizadas

| Componente | Tecnología |
|---|---|
| Lenguaje | PHP 8.2 |
| Framework | Laravel 11 |
| ORM | Eloquent |
| Base de datos | MySQL 8.0 |
| Entorno local | Laragon |
| Gestor de dependencias | Composer |
| Pruebas de API | Postman |

---

## Requisitos previos

Antes de ejecutar el proyecto se debe contar con:

- PHP 8.2 o superior.
- Composer.
- MySQL 8.0.
- Un entorno local como Laragon o XAMPP.
- Postman, opcionalmente, para probar los endpoints.

 
---

## Instalación

### Clonar el repositorio

```bash
git clone https://github.com/camilomaraya/Tech-Solutions---Gestion-de-Proyectos.git
```

Ingresar al directorio del proyecto:

```bash
cd Tech-Solutions---Gestion-de-Proyectos
```

### Instalar dependencias

```bash
composer install
```

### Crear el archivo de entorno

En Windows:

```bash
copy .env.example .env
```

En Linux o macOS:

```bash
cp .env.example .env
```

Luego generar la clave de Laravel:

```bash
php artisan key:generate
```

### Configurar la base de datos

Revisar las credenciales de conexión en el archivo `.env.example`.

Ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_proyectos
DB_USERNAME=root
DB_PASSWORD=
```

Las credenciales deben ajustarse al entorno local donde se ejecute el proyecto.

### Ejecutar migraciones y datos de ejemplo

```bash
php artisan migrate --seed
```

### Levantar el servidor

```bash
php artisan serve
```

Por defecto, el proyecto quedará disponible en:

```text
http://127.0.0.1:8000
```

La ruta base de la API de proyectos es:

```text
http://127.0.0.1:8000/api/proyectos
```

---


## Endpoints de la API

| Método HTTP | Endpoint | Operación | Código de éxito | ID inexistente |
|---|---|---|---:|---:|
| `POST` | `/api/proyectos` | Crear proyecto | `201` | — |
| `GET` | `/api/proyectos` | Listar todos los proyectos | `200` | — |
| `GET` | `/api/proyectos/{id}` | Buscar proyecto por ID | `200` | `404` |
| `PUT` / `PATCH` | `/api/proyectos/{id}` | Actualizar proyecto | `201` | `404` |
| `DELETE` | `/api/proyectos/{id}` | Eliminar proyecto | `204` | `404` |
 
---

## Encabezados utilizados

Todas las peticiones a la API deben incluir:

```http
Accept: application/json
```

Las peticiones que envían información en el cuerpo también deben incluir:

```http
Content-Type: application/json
```

---

## Campos de un proyecto

| Campo | Tipo | Validación |
|---|---|---|
| `nombre` | string | Requerido, máximo 120 caracteres |
| `fechaInicio` | date | Requerido, fecha válida |
| `estado` | string | Requerido |
| `responsable` | string | Requerido, máximo 120 caracteres |
| `monto` | numeric | Requerido, mayor o igual a 0 |

Estados permitidos:

```text
Planificado
En progreso
Finalizado
```

---

## Operaciones CRUD

### 8.1 Crear un proyecto

```http
POST /api/proyectos
```

Ejemplo de solicitud:

```json
{
    "nombre": "API REST Tech Solutions",
    "fechaInicio": "2026-09-10",
    "estado": "Planificado",
    "responsable": "Camilo Meriño",
    "monto": 850000
}
```

Respuesta esperada:

```text
201 Created
```

Todos los campos definidos para la creación son obligatorios y no deben enviarse vacíos.

---

### 8.2 Listar todos los proyectos

```http
GET /api/proyectos
```

Respuesta esperada:

```text
200 OK
```

Si no existen proyectos registrados, la API retorna:

```json
[]
```

manteniendo el código HTTP `200`.

---

### Buscar un proyecto por ID

```http
GET /api/proyectos/{id}
```

Si el proyecto existe:

```text
200 OK
```

Si el proyecto no existe:

```text
404 Not Found
```

---

### Actualizar un proyecto

La API acepta `PUT` y `PATCH`.

```http
PUT /api/proyectos/{id}
```

o:

```http
PATCH /api/proyectos/{id}
```

Ejemplo:

```json
{
    "estado": "Finalizado",
    "monto": 1500000
}
```

Si el proyecto existe:

```text
201 Created
```

Si no existe:

```text
404 Not Found
```

La respuesta incluye los datos actualizados del proyecto.

---

### Eliminar un proyecto

```http
DELETE /api/proyectos/{id}
```

Si el proyecto existe:

```text
204 No Content
```

La respuesta no contiene cuerpo.

Si no existe:

```text
404 Not Found
```

---

## Validaciones

Las validaciones se encuentran separadas del controlador mediante clases **Form Request**.

Archivos principales:

```text
app/Http/Requests/Api/GuardarProyectoRequest.php
app/Http/Requests/Api/ActualizarProyectoRequest.php
```

`GuardarProyectoRequest` contiene las reglas necesarias para crear un proyecto.

`ActualizarProyectoRequest` contiene las reglas utilizadas para modificar un proyecto existente.

---

## Controlador de la API

La lógica CRUD se encuentra en:

```text
app/Http/Controllers/Api/ProyectoApiController.php
```

Métodos principales:

```text
index()     → listar todos los proyectos
store()     → crear un proyecto
show()      → buscar un proyecto por ID
update()    → actualizar un proyecto
destroy()   → eliminar un proyecto
```

---

## Modelo Eloquent

El recurso proyecto está representado mediante:

```text
app/Models/Proyecto.php
```

Eloquent ORM permite interactuar con la tabla de proyectos utilizando modelos y métodos de Laravel.

---

## Rutas API

Las rutas de la evaluación se encuentran definidas en:

```text
routes/api.php
```

Flujo general:

```text
Cliente / Postman
        ↓
    Ruta API
        ↓
ProyectoApiController
        ↓
   Validación
        ↓
 Modelo Proyecto
        ↓
 Eloquent ORM
        ↓
 Base de datos
        ↓
 Respuesta JSON
```

---

## Pruebas con Postman

El repositorio incluye una colección de Postman ubicada en:

```text
docs/Tech Solutions.postman_collection.json
```

Para utilizarla:

1. Abrir Postman.
2. Seleccionar **Import**.
3. Importar el archivo `docs/Tech Solutions.postman_collection.json`.
4. Levantar el servidor Laravel con `php artisan serve`.
5. Ejecutar las peticiones de la colección.

La colección permite comprobar los casos de éxito, validación y recursos inexistentes.

---

## Códigos HTTP utilizados

| Código | Significado | Uso en el proyecto |
|---:|---|---|
| `200` | OK | Listar y obtener proyectos |
| `201` | Created | Crear y actualizar proyectos según indicación docente |
| `204` | No Content | Eliminación exitosa |
| `404` | Not Found | Proyecto solicitado no existe |
| `422` | Unprocessable Content | Error de validación |

---


## Estructura principal 

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── ProyectoApiController.php
│   └── Requests/
│       └── Api/
│           ├── GuardarProyectoRequest.php
│           └── ActualizarProyectoRequest.php
└── Models/
    └── Proyecto.php

database/
├── migrations/
└── seeders/

routes/
└── api.php

docs/
└── Tech Solutions.postman_collection.json
```

---



## Autor

**Camilo Andrés Meriño Araya**  
Desarrollo de Software Web I  
Instituto Profesional San Sebastián
