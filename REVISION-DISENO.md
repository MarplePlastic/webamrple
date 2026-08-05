# Revisión de diseño del sitio — 5 de agosto de 2026

Revisión hecha sobre el sitio corriendo en local (`localhost:8080`), con
capturas reales a 1440×900 (escritorio) y 390×844 (móvil), midiendo el DOM
renderizado. No son impresiones: cada punto trae el dato que lo respalda.

---

## Lo que está bien (no tocar)

- **La paleta está bien construida**: escala `brand` completa de 50 a 950
  (azul industrial) más un acento esmeralda. Es un sistema, no colores sueltos.
- **Tipografía coherente**: Inter para texto, Plus Jakarta Sans para títulos.
- **El hero en móvil funciona**: proporciones correctas, jerarquía clara,
  botones grandes y legibles.
- **Estructura semántica sana**: un solo `H1` por página, jerarquía H1→H2→H3
  ordenada, sin desbordes horizontales en ninguna vista.
- El acceso a WhatsApp está siempre visible.

---

## 1. Problemas que cuestan cotizaciones

### 1.1 El hero no muestra lo que fabrican
La foto de fondo (`METALICO_rollo1`) se lee como una mancha oscura: no se
distingue ningún envase. Un fabricante de packaging tiene que mostrar producto
en la primera pantalla. Además esa imagen **se está ampliando**: mide 1080 px
de ancho y se muestra a 1440 px, así que se ve borrosa (y peor en pantallas
retina). Tampoco tiene `alt`.

### 1.2 Las cifras del hero no son cifras
Hoy dicen: **3** procesos productivos · **100%** a tu medida · **Food** grado
alimentario. Solo la primera es un dato. "100%" y "Food" son eslóganes con
formato de número, y el visitante lo nota. Reemplazar por datos verificables:
años de operación, clientes activos, toneladas al mes, certificaciones, metros
cuadrados de planta.

### 1.3 La página es demasiado larga
**7.421 px en escritorio y 10.709 px en móvil** — casi 13 pantallas de celular.
Y son seis secciones seguidas con el mismo ritmo visual (etiqueta pequeña +
título en mayúsculas + bajada centrada): Todo en un solo lugar, Industrias,
Procesos, Productos, Por qué Marple, Preguntas. Al tercer bloque el ojo ya no
distingue dónde está.

### 1.4 Sin JavaScript, la home aparece vacía
Todo el contenido se revela con `IntersectionObserver` (`.reveal`). Lo comprobé:
la primera captura, tomada sin scrollear, salió **con todas las secciones en
blanco**. Si el JS falla o tarda, el visitante ve una página vacía. Tampoco se
respeta `prefers-reduced-motion`, así que quien tenga reducidas las animaciones
por accesibilidad igual recibe todo animado.

---

## 2. Consistencia visual

### 2.1 Las fotos de producto pelean con la marca
En "Envases que ya fabricamos", las fotos están tomadas sobre fondos saturados
—verde, cian, amarillo, rojo— que no pertenecen a la paleta. En una grilla de
ocho, el resultado es un mosaico ruidoso que compite con el azul de la marca.
El problema **no es el código** (las tarjetas son neutras): es la fotografía.
La solución es unificar el fondo de las tomas (blanco o gris claro) o, como
parche inmediato, aplicar un tratamiento común por CSS.

### 2.2 Las fotos de industrias tienen tratamientos dispares
Luz, encuadre y saturación distintos entre las seis tarjetas de "Industrias que
atendemos". Se ven como imágenes juntadas, no como un set.

### 2.3 La grilla de valores queda coja
Siete tarjetas en una grilla de dos columnas: la última queda huérfana. O son
seis, o son ocho, o la última ocupa el ancho completo.

---

## 3. Detalles técnicos con efecto visible

| Qué | Dato medido | Consecuencia |
|---|---|---|
| Imágenes sobredimensionadas | 1080×725 mostradas a 278×278 (**3,9×**); una de 1536×1024 a 376×282 (**4,1×**) | Se descargan ~14 veces más píxeles de los necesarios. Son 14 imágenes así en la home |
| Imagen del hero ampliada | 1080 px mostrada a 1440 px | Se ve borrosa |
| `H1` mal cortado | Renderiza "Envases plásticos**a** tu medida" | Falta un espacio antes del `<br>`: afecta buscadores y lectores de pantalla |
| Lightbox con `src=""` | `<img id="lightbox-img" src="">` en `includes/footer.php` | HTML inválido; algunos navegadores repiten la petición de la página |
| Imagen del hero sin `alt` | — | Accesibilidad y SEO |

---

## 4. Qué haría, en orden

**Primero — alto impacto, poco trabajo**

1. Cambiar la foto del hero por una que muestre envases reales, exportada al
   ancho correcto (1920 px) y con `alt`.
2. Reemplazar las tres cifras del hero por datos verdaderos.
3. Redimensionar las imágenes de producto a lo que realmente se muestra
   (≈600 px de lado) y servirlas en WebP.
4. Arreglar el espacio del `H1` y el `src` vacío del lightbox.
5. Hacer que el contenido sea visible sin JS (que la animación solo agregue el
   movimiento, no la existencia) y respetar `prefers-reduced-motion`.

**Segundo — consistencia**

6. Unificar el fondo de las fotos de producto.
7. Emparejar el tratamiento de las fotos de industrias.
8. Resolver la grilla de siete valores.

**Tercero — estructura**

9. Acortar la home: fusionar "Todo en un solo lugar" con "Por qué Marple", y
   dejar "Industrias" como una franja compacta.
10. Romper la monotonía alternando la composición de las secciones (texto a un
    lado con imagen al otro, en vez de seis bloques centrados iguales).

---

Capturas usadas para esta revisión: escritorio y móvil de inicio, servicios,
nosotros y contacto, más recortes por sección a 2×.
