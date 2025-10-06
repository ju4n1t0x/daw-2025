# Documentación del Proyecto DAW 2025

## 1. Visión General
Aplicación full stack para gestión de usuarios y ventas. Backend en PHP 8 (arquitectura sencilla MVC + Service + DAO + Router propio). Front-end en React + Vite + Material UI (DataGrid para listados) con autenticación vía JWT y soporte híbrido (token en JSON y cookie HttpOnly opcional).

Base URL Backend: `http://localhost/daw2025/TP/Public`
Base URL Frontend (dev): `http://localhost:3000`

## 2. Arquitectura Backend
Capas principales:
- Controller: Orquesta requests HTTP, valida entrada, formatea salida JSON.
- Service: Lógica de negocio, validaciones adicionales, coordinación DAO.
- DAO: Acceso a datos con PDO (CRUD directo a MySQL).
- Model: Entidades (`Usuario`, `Venta`) con getters y jsonSerialize.
- Core: Conexión singleton a base de datos (`DatabaseConnection`).
- Other Services: Seguridad y utilidades (`PasswordHashService`, `TokenService`).
- Router: `Route` (no mostrado aquí) + `RutasController` que registra endpoints.

Flujo típico (ej: listar ventas):
`/Public/ventas` (GET) -> `RutasController` -> `ProcesarVentas::listarVentas()` -> `VentaService::obtenerTodasLasVentas()` -> `VentaDAO::obtenerTodasLasVentas()` -> formateo fecha -> JSON.

## 3. Estructura de Carpetas (resumen)
```
App/
  Controller/
    AuthController.php
    RutasController.php
    UsuarioController.php
    ProcesarVentas.php
  Service/
    UsuarioService.php
    VentaService.php
    PasswordHashService.php
    TokenService.php
  Dao/
    UsuarioDao.php
    VentaDAO.php
  Model/
    Usuario.php
    Venta.php
core/
  Databaseconnection.php
Front-end/tp-daw/
  src/
    pages/ (Home, SignInPage, Users, Ventas)
    components/ (sign-in, ventas, users, home components)
Public/
  index.php (bootstrap + CORS + dispatch)
```

## 4. Modelos de Datos
### Usuario
Campos: `id`, `nombre_usuario` (en DB) / `nombreUsuario` (en objeto interno), `email`, `contrasena` (hash), `rol`.

Ejemplo JSON respuesta:
```json
{
  "id": 1,
  "nombre_usuario": "juani43",
  "email": "juan@example.com",
  "contrasena": "$2y$10$...",
  "rol": "admin"
}
```

### Venta
Campos: `id_venta`, `fecha` (YYYY-MM-DD en DB, se expone como DD/MM/YYYY), `cuit_cliente`, `monto`.

Ejemplo JSON respuesta:
```json
{
  "id_venta": 5,
  "fecha": "03/10/2025",
  "cuit_cliente": "20333444556",
  "monto": 1500.75
}
```

## 5. Autenticación (JWT Híbrido)
Generación en `AuthController::login()` usando `TokenService::generateToken()`.
Payload:
```json
{
  "sub": <id_usuario>,
  "role": "admin|user",
  "iat": 1696450000,
  "exp": <timestamp_exp>,
  "iss": "daw2025_app_back",
  "aud": "daw2025_app_front"
}
```
Modos soportados:
- Frontend guarda `token` recibido en JSON (sessionStorage/localStorage).
- Backend puede setear cookie HttpOnly `auth_token` (definida en login).

Validación pendiente: implementar middleware que lea `$_COOKIE['auth_token']` o header `Authorization: Bearer <token>` antes de rutas protegidas (ahora endpoints aún no exigen token).

## 6. Endpoints (REST)
Base: `http://localhost/daw2025/TP/Public`

### Auth
| Método | Ruta   | Descripción | Body JSON | Respuesta 200 |
|--------|--------|-------------|-----------|---------------|
| POST   | /login | Login usuario y genera token | `{ "nombre_usuario" o "nombreUsuario", "contrasena" }` | `{ success, message, token, usuario, rol }` |

Ejemplo (Postman / cURL):
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"nombre_usuario":"juani43","contrasena":"123456"}' \
  http://localhost/daw2025/TP/Public/login
```

### Usuarios
| Método | Ruta       | Descripción                | Body JSON (POST) |
|--------|------------|----------------------------|------------------|
| GET    | /usuarios  | Lista todos los usuarios   | - |
| POST   | /usuarios  | Crea un nuevo usuario      | `{ "nombre_usuario", "email", "contrasena", "rol" }` |

Respuesta GET ejemplo:
```json
[
  {"id":1,"nombre_usuario":"juani43","email":"juan@example.com","contrasena":"$2y$10$...","rol":"admin"},
  {"id":2,"nombre_usuario":"alba55","email":"alba@example.com","contrasena":"$2y$10$...","rol":"user"}
]
```

### Ventas
| Método | Ruta     | Descripción                | Body JSON (POST/DELETE) |
|--------|----------|----------------------------|-------------------------|
| GET    | /ventas  | Lista todas las ventas     | - |
| POST   | /ventas  | Crea una venta             | `{ "fecha":"DD/MM/YYYY", "cuit_cliente":"string", "monto": number }` |
| DELETE | /ventas  | Elimina una venta por ID   | `{ "id_venta": number }` |

Respuesta GET ejemplo:
```json
[
  {"id_venta":1,"fecha":"02/10/2025","cuit_cliente":"20111222339","monto":2500},
  {"id_venta":2,"fecha":"03/10/2025","cuit_cliente":"20999888776","monto":1200}
]
```

## 7. Controladores y Funciones Clave
### AuthController
- `login()`: Lee JSON, valida credenciales, genera token JWT, setea cookie `auth_token` (opcional), responde JSON con datos básicos.

### UsuarioController
- `registrarUsuario()`: Valida campos obligatorios, delega a `UsuarioService::registrarUsuario()`.
- `listarUsuarios()`: Obtiene lista, transforma a array plano y responde JSON.

### ProcesarVentas
- `agregarVenta()`: Valida input, normaliza fecha (DD/MM/YYYY -> YYYY-MM-DD), invoca service, responde 201 o error.
- `listarVentas()`: Mapea entidades a JSON formateando fecha.
- `eliminarVenta()`: Verifica existencia y elimina; maneja 404 y 500.

## 8. Services (Lógica de negocio)
### UsuarioService
- `registrarUsuario()`: Hashea contraseña, instancia `Usuario`, delega guardado a DAO.
- `findByUsername()`: Wrapper con validación básica.
- `obtenerTodosLosUsuarios()`: Maneja excepciones y burbujea mensaje.

### VentaService
- `agregarVenta()`: Valida campos (no vacíos, monto numérico > 0), crea entidad y delega.
- `obtenerTodasLasVentas()`: Recupera lista con manejo de excepciones.
- `eliminarVenta()`: Verifica existencia previa antes de eliminar (consistencia lógica).

## 9. DAO (Acceso a Datos)
### UsuarioDao
- `save(Usuario)`: INSERT parametrizado (previene SQL injection).
- `findByUsername(nombre)`: SELECT con LIMIT 1 y crea entidad o `null`.
- `obtenerTodosLosUsuarios()`: SELECT * ORDER BY id ASC, crea arreglo de entidades.

### VentaDAO
- `agregarVenta(Venta)`: INSERT parametrizado.
- `obtenerTodasLasVentas()`: SELECT ordenado por `id_venta` ascendente.
- `eliminarVenta(id)`: DELETE por ID usando prepared statement.
- `obtenerVentaPorId(id)`: SELECT single para validación previa.

## 10. Utilidades / Infraestructura
### PasswordHashService
- `hashPassword(contrasena)`: Wrapper de `password_hash()`.
- `verifyPassword(contrasena, hash)`: Wrapper de `password_verify()`.

### TokenService
- `generateToken(usuario)`: Construye payload y firma con HS256.
- `validateToken(token)`: Decodifica y retorna payload o `null` si inválido/expirado.

### DatabaseConnection (Singleton)
- `getInstance()`: Garantiza única conexión.
- `getConnection()`: Devuelve instancia PDO configurada (errores como excepciones).

## 11. Front-end (React + Vite + MUI)
Estructura:
- `pages/`: `SignInPage`, `Home`, `Users`, `Ventas`.
- `components/`: Formularios (`FormSignIn`, `AgregarVentas`), tablas (`VentasList`, `UsersTable`), navegación (`NavBar`, `Menu`).
- DataGrid: Requiere campo `id` (en ventas se transforma `id_venta` -> `id`).

Flujo principal:
1. Login envía POST `/login`.
2. Guarda `token` (sessionStorage) y/o backend setea cookie.
3. Navega a `/home` y carga listas (`/usuarios`, `/ventas`).
4. Formularios hacen POST y fuerzan refresh mediante estado de `location` o re-fetch.

## 12. Ejemplos Postman / cURL
### Crear Usuario
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"nombre_usuario":"nuevoUser","email":"nuevo@example.com","contrasena":"Secreta123","rol":"user"}' \
  http://localhost/daw2025/TP/Public/usuarios
```

### Listar Usuarios
```bash
curl http://localhost/daw2025/TP/Public/usuarios
```

### Crear Venta
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"fecha":"05/10/2025","cuit_cliente":"20333555119","monto":1800}' \
  http://localhost/daw2025/TP/Public/ventas
```

### Eliminar Venta
```bash
curl -X DELETE \
  -H "Content-Type: application/json" \
  -d '{"id_venta":3}' \
  http://localhost/daw2025/TP/Public/ventas
```

## 13. Posibles Mejoras Futuras
- Middleware de autorización para proteger `/usuarios` y `/ventas` (JWT obligatorio).
- Refrescar token (refresh token / renovación silenciosa antes de expirar).
- Paginación y filtros en listados.
- Soft delete o auditoría (quién creó/eliminó ventas/usuarios).
- Tests unitarios (PHPUnit) y front (Jest/RTL).
- Manejo de roles (admin vs user) en front-end (ocultar funcionalidades restringidas).

## 14. Notas Importantes
- Contraseñas se almacenan hasheadas (nunca usar texto plano en producción).
- El campo `contrasena` se expone en API por requerimiento académico (retirar en producción).
- Fechas de ventas se transforman a formato legible al responder.
- Consistencia de naming: DB usa `snake_case` (`nombre_usuario`), modelos pueden usar camelCase internamente.

---
© 2025 - Proyecto DAW 2025
