# Tech Solutions — API REST de Gestión de Proyectos

---
 
Implementa las operaciones **CRUD** completas sobre el recurso `proyectos`, con validaciones
mediante *Form Requests* y códigos de respuesta HTTP acordes a cada operación.
 
Continúa el caso de estudio de las unidades anteriores: los controladores web y el patrón MVC
provienen de la Unidad 1, y la persistencia con Eloquent sobre MySQL de la Unidad 2.
 
## Índice
 
- [Stack tecnológico](#stack-tecnológico)
- [Arquitectura](#arquitectura)
- [Instalación](#instalación)
- [Endpoints](#endpoints)
- [Ejemplos de uso](#ejemplos-de-uso)
- [Notas de implementación](#notas-de-implementación)
- [Pruebas](#pruebas)
## Stack tecnológico
 
| Componente | Versión / Tecnología |
| :--- | :--- |
| Lenguaje | PHP 8.2 |
| Framework | Laravel 11.56.1 |
| ORM | Eloquent |
| Base de datos | MySQL 8.0 |
| Entorno local | Laragon |
 
## Arquitectura
 
La capa API convive con la capa web sin interferir: los controladores de `Api/` devuelven JSON,
mientras los de la raíz siguen devolviendo vistas Blade.
 
```
gestion-proyectos/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── ProyectoApiController.php   # CRUD REST (Unidad 3)
│   │   │   └── ...                             # Controladores web (Unidad 1)
│   │   └── Requests/Api/
│   │       ├── GuardarProyectoRequest.php      # Validaciones del POST
│   │       └── ActualizarProyectoRequest.php   # Validaciones del PUT/PATCH
│   ├── Models/
│   │   ├── Proyecto.php                        # Modelo Eloquent
│   │   └── Usuario.php
│   └── Services/
│       └── ProyectoServicio.php
├── database/
│   ├── migrations/                             # usuarios, proyectos
│   └── seeders/                                # Datos de ejemplo
├── routes/
│   ├── api.php                                 # Rutas REST (Unidad 3)
│   └── web.php                                 # Rutas web (Unidad 1)
└── docs/
    └── Tech Solutions.postman_collection.json  # Colección de pruebas
```
 
## Instalación
 
> **Requisitos previos:** PHP 8.2+, Composer, MySQL 8.0 y un entorno local como Laragon o XAMPP.
 
**1. Clona el repositorio**
 
```bash
git clone https://github.com/camilomaraya/Tech-Solutions---Gestion-de-Proyectos.git
cd gestion-proyectos
```
 
**2. Instala las dependencias**
 
```bash
composer install
```
 
**3. Crea el archivo de entorno**
 
```bash
cp .env.example .env      # Windows: copy .env.example .env
php artisan key:generate
```
 
**4. Configura la base de datos**
 
El archivo `.env.example` ya incluye las credenciales requeridas por la evaluación:
 

 
**5. Ejecuta migraciones y datos de ejemplo**
 
```bash
php artisan migrate --seed
```
 
Si Laravel pregunta si desea crear la base de datos, responde que sí.
 
**6. Levanta el servidor**
 
```bash
php artisan serve
```
 
La API queda disponible en `http://127.0.0.1:8000/api/proyectos`
 
## Endpoints
 
Base: `http://127.0.0.1:8000/api`
 
| Método | Ruta | Descripción | Éxito | ID inexistente |
| :--- | :--- | :--- | :---: | :---: |
| `GET` | `/proyectos` | Lista todos los proyectos | `200` | — |
| `POST` | `/proyectos` | Crea un proyecto | `201` | — |
| `GET` | `/proyectos/{id}` | Obtiene un proyecto por su ID | `200` | `404` |
| `PUT` `PATCH` | `/proyectos/{id}` | Actualiza un proyecto | `201` | `404` |
| `DELETE` | `/proyectos/{id}` | Elimina un proyecto | `204` | `404` |
 
> [!NOTE]
> Todas las peticiones deben incluir el encabezado `Accept: application/json`, y las que envían
> cuerpo también `Content-Type: application/json`.
 
<details>
<summary><strong>Campos del recurso y reglas de validación</strong></summary>
<br>
| Campo | Tipo | Reglas |
| :--- | :--- | :--- |
| `nombre` | string | Requerido, máximo 120 caracteres |
| `fechaInicio` | date | Requerido, formato de fecha válido |
| `estado` | string | Requerido: `Planificado`, `En progreso` o `Finalizado` |
| `responsable` | string | Requerido, máximo 120 caracteres |
| `monto` | numeric | Requerido, mayor o igual a 0 |
 
El campo `created_by` se asigna automáticamente desde la sesión del usuario autenticado en la
capa web y queda `null` para los registros creados vía API.
 
</details>
## Ejemplos de uso
 
### Crear un proyecto
 
```http
POST /api/proyectos
Content-Type: application/json
Accept: application/json
```
 
```json
{
    "nombre": "API REST Tech Solutions",
    "fechaInicio": "2026-09-10",
    "estado": "Planificado",
    "responsable": "Camilo Meriño",
    "monto": 850000
}
```
 
**Respuesta** — `201 Created`
 
```json
{
    "nombre": "API REST Tech Solutions",
    "fechaInicio": "2026-09-10",
    "estado": "Planificado",
    "responsable": "Camilo Meriño",
    "monto": 850000,
    "updated_at": "2026-09-06T02:15:33.000000Z",
    "created_at": "2026-09-06T02:15:33.000000Z",
    "id": 6
}
```
 
<details>
<summary><strong>Error de validación</strong> — <code>422 Unprocessable Content</code></summary>
<br>
```json
{
    "message": "El campo nombre es obligatorio. (y 4 errores más)",
    "errors": {
        "nombre": ["El campo nombre es obligatorio."],
        "fechaInicio": ["El campo fecha inicio es obligatorio."],
        "estado": ["El estado debe ser: Planificado, En progreso o Finalizado."],
        "responsable": ["El campo responsable es obligatorio."],
        "monto": ["El campo monto es obligatorio."]
    }
}
```
 
</details>
<details>
<summary><strong>Recurso no encontrado</strong> — <code>404 Not Found</code></summary>
<br>
El código se devuelve como **estado HTTP real**, no dentro del cuerpo de la respuesta.
 
```json
{
    "message": "No query results for model [App\\Models\\Proyecto] 9999"
}
```
 
</details>
## Notas de implementación
 
**Manejo de errores con `findOrFail()`**
En lugar de validar manualmente la existencia del registro, se utiliza `findOrFail()`, que lanza
una excepción `ModelNotFoundException`. Laravel la traduce automáticamente a un `404` con cuerpo
JSON cuando la petición declara `Accept: application/json`.
 
**Código `201` en la actualización**
El enunciado presenta una inconsistencia: en el encabezado del requerimiento indica `201` y en el
detalle `200`. Ante la consulta realizada en el foro de la asignatura, el docente aclaró que
corresponde devolver **`201`**, criterio adoptado en esta implementación. Cabe señalar que la
convención REST habitual para una actualización es `200`, reservando `201` para la creación de
recursos.
 
**Respuesta vacía en la eliminación**
Se utiliza `response()->noContent()`, que devuelve `204` sin cuerpo, en lugar de
`response()->json(null, 204)`, que enviaría el literal `null` como contenido.
 
**Validación desacoplada**
Las reglas viven en clases *Form Request* separadas del controlador. La clase de actualización
emplea `sometimes` junto a `required`, lo que permite que `PATCH` envíe solo los campos a
modificar sin exigir el resto, pero rechazando valores vacíos en los que sí se envían.
 
**Arreglo vacío en el listado**
Cuando no existen registros, `GET /proyectos` devuelve `[]` con estado `200`, según lo requerido.
 
## Pruebas
 
La carpeta `docs/` incluye una colección de Postman con las nueve peticiones que cubren los casos
de éxito y de error de cada endpoint.
 
Para usarla: **Import** → seleccionar el archivo `.json` → ejecutar con el servidor levantado.
 
---
## Autor

Camilo Andrés Meriño Araya — Desarrollo de Software Web I — Instituto Profesional San Sebastián
# Tech-Solutions---Gestion-de-Proyectos
