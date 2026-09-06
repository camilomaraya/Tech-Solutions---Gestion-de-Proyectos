# Evaluación 3 — API REST de Gestión de Proyectos
## Desarrollo de Software Web I

---

Este proyecto corresponde a la **Evaluación 3 de Desarrollo de Software Web I**.

El objetivo es implementar las operaciones CRUD para la gestión de proyectos mediante una API REST desarrollada con Laravel. Continúa el caso de estudio de las unidades anteriores: los controladores web provienen de la Unidad 1 y los modelos Eloquent de la Unidad 2.

La implementación utiliza controladores de API, modelos Eloquent, validaciones mediante Form Requests y códigos de respuesta HTTP de acuerdo con los requerimientos de la evaluación.

---

## Tecnologías utilizadas

| Componente | Tecnología |
|---|---|
| Lenguaje | PHP 8.2 |
| Framework | Laravel 11.56 |
| ORM | Eloquent |
| Base de datos | MySQL 8.0 |
| Entorno local | Laragon |
| Gestor de dependencias | Composer |
| Pruebas de API | Postman |

---

## Instalación

Se requiere PHP 8.2 o superior, Composer, MySQL 8.0 y un entorno local como Laragon o XAMPP.

**1. Clonar el repositorio**

```bash
git clone https://github.com/camilomaraya/Tech-Solutions---Gestion-de-Proyectos.git
cd Tech-Solutions---Gestion-de-Proyectos
```

**2. Instalar dependencias**

```bash
composer install
```

**3. Crear el archivo de entorno**

```bash
copy .env.example .env      # Linux o macOS: cp .env.example .env
php artisan key:generate
```

**4. Configurar la base de datos**

El archivo `.env.example` incluye las credenciales requeridas por la evaluación:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desarrollo_software_1
DB_USERNAME=root
DB_PASSWORD=desarrollo_software_1
```

La clave del usuario `root` de MySQL debe coincidir con ese valor. Si la instalación local usa otra, debe ajustarse en el `.env` antes de continuar.

**5. Ejecutar migraciones y datos de ejemplo**

```bash
php artisan migrate --seed
```

**6. Levantar el servidor**

```bash
php artisan serve
```

La ruta base de la API queda disponible en `http://127.0.0.1:8000/api/proyectos`

---

## Endpoints de la API

| Método HTTP | Endpoint | Operación | Código de éxito | ID inexistente |
|---|---|---|---:|---:|
| `POST` | `/api/proyectos` | Crear proyecto | `201` | — |
| `GET` | `/api/proyectos` | Listar todos los proyectos | `200` | — |
| `GET` | `/api/proyectos/{id}` | Buscar proyecto por ID | `200` | `404` |
| `PUT` / `PATCH` | `/api/proyectos/{id}` | Actualizar proyecto | `201` | `404` |
| `DELETE` | `/api/proyectos/{id}` | Eliminar proyecto | `204` | `404` |

Todas las peticiones deben incluir el encabezado `Accept: application/json`. Las que envían información en el cuerpo también requieren `Content-Type: application/json`.

Cuando no existen proyectos registrados, el listado retorna un arreglo vacío `[]` manteniendo el código `200`. La eliminación exitosa responde `204` sin cuerpo.

### Campos de un proyecto

| Campo | Tipo | Validación |
|---|---|---|
| `nombre` | string | Requerido, máximo 120 caracteres |
| `fechaInicio` | date | Requerido, fecha válida |
| `estado` | string | Requerido: `Planificado`, `En progreso` o `Finalizado` |
| `responsable` | string | Requerido, máximo 120 caracteres |
| `monto` | numeric | Requerido, mayor o igual a 0 |

### Ejemplo de creación

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

Respuesta `201 Created` con el proyecto creado y su ID asignado. Todos los campos son obligatorios y no deben enviarse vacíos.

---

## Códigos HTTP utilizados

| Código | Significado | Uso en el proyecto |
|---:|---|---|
| `200` | OK | Listar y obtener proyectos |
| `201` | Created | Crear y actualizar proyectos |
| `204` | No Content | Eliminación exitosa |
| `404` | Not Found | Proyecto solicitado no existe |
| `422` | Unprocessable Content | Error de validación |

### Sobre el código `201` en la actualización

El enunciado de la evaluación presenta una inconsistencia: en el encabezado del requerimiento indica `201` y en el detalle `200`. Ante la consulta realizada en el foro de la asignatura, el docente aclaró que corresponde devolver **`201`**, criterio adoptado en esta implementación.

Cabe señalar que la convención REST habitual reserva `201` para la creación de recursos y utiliza `200` para las actualizaciones.

---

## Validaciones

Las validaciones están separadas del controlador mediante clases **Form Request**:

```text
app/Http/Requests/Api/GuardarProyectoRequest.php
app/Http/Requests/Api/ActualizarProyectoRequest.php
```

`GuardarProyectoRequest` exige todos los campos para la creación. `ActualizarProyectoRequest` aplica la regla `sometimes`, lo que permite que `PATCH` envíe solo los campos a modificar sin exigir el resto, rechazando de todas formas los valores vacíos en aquellos que sí se envían.

Cuando una validación falla, la API responde `422` con el detalle de los errores por campo.

La búsqueda de registros utiliza `findOrFail()`, que lanza una excepción `ModelNotFoundException`. Laravel la traduce automáticamente a un `404` como estado HTTP real, no dentro del cuerpo de la respuesta.

---

## Pruebas con Postman

El repositorio incluye una colección de Postman en `docs/Tech Solutions.postman_collection.json` con las peticiones que cubren los casos de éxito, validación y recursos inexistentes.

Para utilizarla: abrir Postman, seleccionar **Import**, cargar el archivo, levantar el servidor con `php artisan serve` y ejecutar las peticiones.

---

## Autor

**Camilo Andrés Meriño Araya**
Desarrollo de Software Web I
Instituto Profesional San Sebastián
