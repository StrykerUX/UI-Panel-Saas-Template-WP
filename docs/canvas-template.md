# Plantilla Canvas para UI Panel SAAS

La plantilla Canvas es una nueva adición al theme UI Panel SAAS que proporciona un lienzo flexible para crear layouts complejos utilizando CSS Flexbox. Diseñada específicamente para ser compatible con shortcodes de WordPress y plugins de terceros, esta plantilla le permite crear diseños responsivos con un ancho del 100% (sin tener en cuenta el espacio del menú lateral) y un ancho máximo de 1680px.

## Características principales

- **Diseño de ancho completo**: Proporciona un espacio de trabajo sin las restricciones de márgenes estándar.
- **Completamente responsivo**: Se adapta automáticamente a diferentes tamaños de pantalla.
- **Compatible con shortcodes**: Integración perfecta con shortcodes nativos de WordPress y plugins de terceros.
- **Sistema de rejilla flexible**: Utiliza CSS Flexbox para crear layouts complejos de manera sencilla.
- **Shortcodes personalizados**: Incluye shortcodes especialmente diseñados para facilitar la creación de layouts flexibles.
- **Modo oscuro compatible**: Se adapta automáticamente al modo oscuro del tema.

## Cómo utilizar la plantilla Canvas

1. Cree una nueva página en WordPress.
2. En el panel lateral derecho, en "Atributos de página", seleccione "Canvas" en el menú desplegable de plantillas.
3. Utilice el editor de WordPress para agregar su contenido, incluyendo shortcodes de la plantilla Canvas o de plugins de terceros.
4. Publique o actualice la página para ver el resultado.

## Shortcodes incluidos

La plantilla Canvas incluye los siguientes shortcodes para crear layouts flexibles:

### Estructura básica

#### `[flex_row]...[/flex_row]`

Crea una fila horizontal con elementos flexibles.

**Atributos:**
- `justify`: Alineación horizontal de los elementos (`start`, `center`, `end`, `between`, `around`, `evenly`)
- `align`: Alineación vertical de los elementos (`start`, `center`, `end`, `stretch`)
- `gap`: Espacio entre elementos (`5`, `10`, `15`, `20`, `30`)
- `class`: Clases CSS adicionales
- `style`: Estilos CSS inline

**Ejemplo:**
```
[flex_row justify="between" align="center" gap="20"]
  [flex_item size="6"]Contenido de la columna 1[/flex_item]
  [flex_item size="6"]Contenido de la columna 2[/flex_item]
[/flex_row]
```

#### `[flex_column]...[/flex_column]`

Crea una columna vertical con elementos flexibles.

**Atributos:**
- `justify`: Alineación vertical de los elementos (`start`, `center`, `end`, `between`, `around`, `evenly`)
- `align`: Alineación horizontal de los elementos (`start`, `center`, `end`, `stretch`)
- `gap`: Espacio entre elementos (`5`, `10`, `15`, `20`, `30`)
- `class`: Clases CSS adicionales
- `style`: Estilos CSS inline

**Ejemplo:**
```
[flex_column justify="start" align="center" gap="15"]
  [canvas_card title="Elemento 1"]Contenido 1[/canvas_card]
  [canvas_card title="Elemento 2"]Contenido 2[/canvas_card]
[/flex_column]
```

#### `[flex_item]...[/flex_item]`

Define un elemento flexible dentro de una fila o columna.

**Atributos:**
- `size`: Tamaño del elemento en una escala de 1 a 12 (sistema de rejilla)
- `md`: Tamaño en pantallas medianas
- `class`: Clases CSS adicionales
- `style`: Estilos CSS inline

**Ejemplo:**
```
[flex_item size="4" md="6"]
  Contenido del elemento
[/flex_item]
```

### Elementos de contenido

#### `[canvas_card]...[/canvas_card]`

Crea una tarjeta con estilo para mostrar contenido.

**Atributos:**
- `title`: Título de la tarjeta
- `icon`: Icono de Tabler Icons (ej. `ti-user`)
- `class`: Clases CSS adicionales
- `style`: Estilos CSS inline

**Ejemplo:**
```
[canvas_card title="Mi tarjeta" icon="ti-info-circle"]
  Este es el contenido de mi tarjeta.
[/canvas_card]
```

#### `[canvas_section]...[/canvas_section]`

Crea una sección con título opcional.

**Atributos:**
- `title`: Título de la sección
- `class`: Clases CSS adicionales
- `style`: Estilos CSS inline

**Ejemplo:**
```
[canvas_section title="Mi sección"]
  Contenido de la sección
[/canvas_section]
```

## Ejemplo de uso completo

```
[canvas_section title="Dashboard de usuario"]
  [flex_row gap="20"]
    [flex_item size="8"]
      [canvas_card title="Bienvenido" icon="ti-user"]
        <p>Bienvenido a tu dashboard. Aquí puedes gestionar toda tu información.</p>
      [/canvas_card]
    [/flex_item]
    [flex_item size="4"]
      [canvas_card title="Estadísticas" icon="ti-chart-bar"]
        <p>Tus estadísticas mensuales:</p>
        <ul>
          <li>Visitas: 1,245</li>
          <li>Ventas: 42</li>
          <li>Comentarios: 38</li>
        </ul>
      [/canvas_card]
    [/flex_item]
  [/flex_row]
  
  [flex_row justify="between" gap="20" class="mt-4"]
    [flex_item size="4"]
      [canvas_card title="Actividad reciente" icon="ti-activity"]
        <p>Tu actividad reciente en la plataforma.</p>
      [/canvas_card]
    [/flex_item]
    [flex_item size="4"]
      [canvas_card title="Mensajes" icon="ti-mail"]
        <p>Tienes 3 mensajes sin leer.</p>
      [/canvas_card]
    [/flex_item]
    [flex_item size="4"]
      [canvas_card title="Tareas" icon="ti-checklist"]
        <p>5 tareas pendientes para hoy.</p>
      [/canvas_card]
    [/flex_item]
  [/flex_row]
[/canvas_section]
```

## Compatibilidad con plugins

La plantilla Canvas es compatible con la mayoría de los plugins de WordPress que utilizan shortcodes. Algunos ejemplos de plugins con los que funciona bien:

- Contact Form 7
- WooCommerce
- Elementor
- WPBakery Page Builder
- Gravity Forms

## Clases CSS útiles

Además de los shortcodes, puede utilizar las siguientes clases CSS en sus elementos:

- `.flex-row`: Crea un contenedor flex horizontal
- `.flex-column`: Crea un contenedor flex vertical
- `.flex-col-1` a `.flex-col-12`: Define el ancho de las columnas (sistema de 12 columnas)
- `.justify-start`, `.justify-center`, `.justify-end`, `.justify-between`, `.justify-around`, `.justify-evenly`: Justificación de elementos
- `.align-start`, `.align-center`, `.align-end`, `.align-stretch`: Alineación de elementos
- `.gap-5`, `.gap-10`, `.gap-15`, `.gap-20`, `.gap-30`: Espaciado entre elementos
- `.canvas-card`: Estilo de tarjeta básico
- `.canvas-box`: Contenedor básico sin estilos de tarjeta
- `.equal-height`: Hace que todos los elementos hijos tengan la misma altura
- `.clickable`: Hace que el elemento sea clickable por completo (útil para tarjetas con enlaces)

## Personalizando la plantilla

Puede personalizar el aspecto de la plantilla Canvas modificando los siguientes archivos:

- `assets/css/canvas.css`: Estilos base de la plantilla
- `assets/js/canvas.js`: Funcionalidades JavaScript de la plantilla
- `page-templates/canvas.php`: Estructura HTML de la plantilla

## Solución de problemas

**El layout no es responsivo en dispositivos móviles**

Asegúrese de que está utilizando correctamente los shortcodes `[flex_row]` y `[flex_item]` con los atributos adecuados.

**Los shortcodes no funcionan correctamente**

Verifique que no haya espacios adicionales antes o después de los corchetes de apertura y cierre de los shortcodes.

**Las tarjetas no tienen la misma altura**

Agregue la clase `equal-height` al contenedor `[flex_row]` para que todas las tarjetas tengan la misma altura.

---

Para más información y soporte, visite la documentación completa del tema UI Panel SAAS o contacte al equipo de soporte.
