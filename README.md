# UI Panel SAAS Template para WordPress

Un tema WordPress premium diseñado para aplicaciones SaaS y paneles de administración con una interfaz moderna, responsiva y personalizable.

![UI Panel SAAS Template](https://placeholder-for-screenshot.com/ui-panel-saas-screenshot.jpg)

## 📋 Características principales

- **Diseño 100% responsivo** - Funciona perfectamente en dispositivos móviles, tablets y escritorio
- **Panel de administración moderno** - Con widgets personalizables y gráficos interactivos
- **Soporte para WooCommerce** - Integración perfecta con el comercio electrónico
- **Múltiples plantillas de página** - Dashboard, perfiles, informes y más
- **Menú lateral personalizable** - Con soporte para múltiples niveles y iconos
- **Tema oscuro/claro** - Soporte para cambiar entre modo claro y oscuro
- **Altamente personalizable** - Opciones extensas del personalizador de WordPress
- **Optimizado para SEO** - Estructura semántica y código limpio

## 🚀 Instalación

### Requisitos previos
- WordPress 5.8+
- PHP 7.4+
- MySQL 5.6+ o MariaDB 10.1+

### Instalación manual
1. Descarga la última versión del tema desde GitHub.
2. Ve al panel de administración de WordPress > Apariencia > Temas > Añadir nuevo.
3. Haz clic en "Subir tema".
4. Selecciona el archivo ZIP descargado y haz clic en "Instalar ahora".
5. Una vez instalado, haz clic en "Activar".

### Instalación mediante FTP
1. Extrae el archivo ZIP descargado en tu computadora.
2. Sube la carpeta extraída al directorio `/wp-content/themes/` de tu servidor.
3. Ve al panel de administración de WordPress > Apariencia > Temas.
4. Busca "UI Panel SAAS" y haz clic en "Activar".

## 📂 Estructura del tema

```
ui-panel-saas/
├── inc/                           # Funciones y clases adicionales
│   ├── class-ui-panel-saas-walker-nav-menu.php # Personalización del menú de navegación
│   ├── customizer.php             # Configuración del personalizador
│   ├── helpers.php                # Funciones de ayuda
│   ├── template-functions.php     # Funciones de plantilla
│   └── template-tags.php          # Etiquetas de plantilla reutilizables
├── page-templates/                # Plantillas de página
│   ├── dashboard.php              # Plantilla para el dashboard principal
│   └── (futuras plantillas)
├── template-parts/                # Partes reutilizables de plantillas
│   ├── content-none.php           # Para cuando no hay contenido
│   ├── content.php                # Estructura del contenido
│   └── theme-settings.php         # Ajustes del tema
├── footer.php                     # Pie de página
├── functions.php                  # Funciones principales del tema
├── header.php                     # Cabecera
├── index.php                      # Archivo principal
├── sidebar.php                    # Barra lateral
└── style.css                      # Hoja de estilos principal y datos del tema
```

## 🛠️ Personalización

### Personalizador de WordPress
El tema incluye numerosas opciones en el personalizador de WordPress (Apariencia > Personalizar):

1. **Colores del tema**
   - Color primario
   - Color secundario
   - Color de acento
   - Colores del sidebar

2. **Opciones de diseño**
   - Ajustes del sidebar
   - Diseño del header
   - Estilo de menú

3. **Opciones del dashboard**
   - Widgets visibles
   - Orden de los widgets
   - Opciones de gráficos

### Añadir elementos al menú

El tema incluye un sistema de menú avanzado que soporta iconos y múltiples niveles de menú.

1. Ve a Apariencia > Menús en el panel de administración.
2. Crea o edita un elemento del menú.
3. En la pestaña "Configuración CSS del elemento", añade una clase que comience con `ri-` seguida del nombre del icono de Remix Icon.
   - Ejemplo: `ri-dashboard-line` para icono de dashboard.
4. Los submenús se muestran automáticamente como elementos desplegables.

## 📱 Plantillas disponibles

### Dashboard (dashboard.php)
Una plantilla completa para crear un dashboard administrativo con:

- **Widgets estadísticos** - Muestra KPIs importantes como ventas, visitas, devoluciones y ganancias.
- **Gráficos interactivos** - Visualización de datos usando ApexCharts.
- **Tabla de órdenes recientes** - Muestra las últimas transacciones.
- **Actividades recientes** - Registro de actividades de usuarios.
- **Fuentes de tráfico** - Gráfico de distribución de tráfico.

#### Uso:
1. Crea una nueva página en WordPress.
2. En el panel de atributos de página, selecciona "Dashboard" como plantilla.
3. Publica la página.

#### Filtros disponibles:
El dashboard incluye varios filtros de WordPress para personalizar los datos mostrados:

```php
// Ejemplos de personalización de datos del dashboard
add_filter('ui_panel_saas_dashboard_orders_count', function($count) {
    // Conecta con tu sistema de órdenes para obtener datos reales
    return $count; 
});

add_filter('ui_panel_saas_dashboard_income_data', function($data) {
    // Personaliza los datos de ingresos en el gráfico
    return $data;
});
```

## 🌈 Clases CSS y utilidades

El tema utiliza un sistema de clases CSS basado en Bootstrap 5 con algunas personalizaciones adicionales:

### Clases de color
- `.text-primary`, `.bg-primary` - Color primario
- `.text-success`, `.bg-success` - Verde/Éxito
- `.text-danger`, `.bg-danger` - Rojo/Error
- `.text-warning`, `.bg-warning` - Amarillo/Advertencia
- `.text-info`, `.bg-info` - Azul/Información

### Clases de tarjetas
- `.card` - Contenedor base para tarjetas
- `.card-body` - Cuerpo de la tarjeta
- `.card-header` - Encabezado de tarjeta
- `.card-footer` - Pie de tarjeta

### Clases de avatar
- `.avatar-xs`, `.avatar-sm`, `.avatar-md`, `.avatar-lg`, `.avatar-xl` - Tamaños de avatar

## ⚙️ Soporte para WooCommerce

El tema incluye soporte para WooCommerce con estilos personalizados que coinciden con la interfaz general del panel.

### Integración de productos:
Si WooCommerce está activo, la plantilla de dashboard muestra datos reales:

- Pedidos recientes
- Total de ventas
- Estadísticas de productos

## 🧩 Creación de widgets personalizados

Puedes añadir widgets personalizados al dashboard fácilmente:

1. Registra una zona de widgets en tu archivo `functions.php` o en un plugin:

```php
function ui_panel_saas_register_widgets() {
    register_sidebar(array(
        'name'          => __('Dashboard', 'ui-panel-saas'),
        'id'            => 'dashboard',
        'description'   => __('Widgets para mostrar en el dashboard', 'ui-panel-saas'),
        'before_widget' => '<div class="col-md-6 col-xl-4"><div class="card">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="card-header"><h4 class="header-title">',
        'after_title'   => '</h4></div><div class="card-body">',
    ));
}
add_action('widgets_init', 'ui_panel_saas_register_widgets');
```

2. Ahora puedes añadir widgets a esta área desde Apariencia > Widgets.

## 📊 Creación de gráficos personalizados

El tema utiliza ApexCharts para los gráficos. Puedes crear tus propios gráficos siguiendo estos pasos:

1. Añade un contenedor HTML para el gráfico en tu plantilla:
```html
<div id="mi-grafico" style="height: 300px;"></div>
```

2. Inicializa el gráfico con JavaScript:
```javascript
var options = {
    chart: {
        height: 300,
        type: 'line',
        toolbar: {
            show: false
        }
    },
    series: [{
        name: 'Datos',
        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
    }],
    xaxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep']
    }
};

var chart = new ApexCharts(
    document.querySelector("#mi-grafico"),
    options
);

chart.render();
```

## 🌙 Modo oscuro

El tema incluye soporte para cambiar entre modo claro y oscuro:

1. Los usuarios pueden alternar entre ambos temas usando el botón en el sidebar o header.
2. La preferencia se guarda automáticamente usando localStorage.
3. Todas las interfaces se adaptan automáticamente al modo seleccionado.

## 📱 Responsividad

El tema está completamente optimizado para diferentes tamaños de pantalla:

- **Escritorio**: Diseño completo con sidebar expandido
- **Tablet**: Sidebar colapsable con iconos
- **Móvil**: Sidebar oculto con menú hamburguesa y diseño simplificado

## 🔒 Seguridad

Todas las funciones del tema siguen las mejores prácticas de seguridad de WordPress:

- Datos escapados correctamente usando `esc_html()`, `esc_attr()`, etc.
- Validación de datos de entrada
- Verificación de nonces para formularios
- Comprobación de permisos

## 🌐 Internacionalización (i18n)

El tema está completamente preparado para traducción:

- Todas las cadenas de texto utilizan funciones de WordPress como `__()`, `esc_html__()`, etc.
- Dominio de texto 'ui-panel-saas' para todas las cadenas
- Archivos .pot incluidos para facilitar la traducción

## 🚀 Rendimiento

Optimizaciones de rendimiento incorporadas:

- CSS y JavaScript minificados
- Carga condicional de scripts
- Uso de técnicas de lazy loading
- Imágenes optimizadas

## 📜 Registro de cambios

### Versión 1.0.0
- Lanzamiento inicial
- Dashboard principal
- Soporte para WooCommerce
- Modo oscuro/claro

## 📝 Próximas características

- Plantilla de página de perfil de usuario
- Plantilla para visualización de analíticas avanzadas
- Plantilla para gestión de suscripciones
- Plantilla para configuración de cuenta
- Plantilla de lista de facturación/facturas

## 👨‍💻 Desarrollo

Para contribuir al desarrollo:

1. Haz un fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. Haz commit de tus cambios (`git commit -m 'Añadir nueva característica'`)
4. Haz push a la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## 📄 Licencia

Este tema está licenciado bajo [GPL v2 o posterior](https://www.gnu.org/licenses/gpl-2.0.html).

## 📞 Soporte

Si necesitas ayuda con este tema, puedes:

1. Revisar la documentación
2. Abrir un issue en GitHub
3. Contactar al desarrollador directamente

---

Desarrollado con ❤️ por StrykerUX
