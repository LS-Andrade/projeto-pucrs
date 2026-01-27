# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer Bearer {YOUR_TOKEN_HERE}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Para obter seu token de autenticação, faça login através do endpoint <code>/api/auth/login</code>. O token deve ser incluído no header Authorization como <code>Bearer {token}</code>.
