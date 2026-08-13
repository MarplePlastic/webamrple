# Imágenes a rehacer con IA — encargo

Qué imagen hay que generar, con qué medida, y el texto listo para pegar en la
herramienta que se use (ChatGPT/DALL·E, Midjourney, Gemini, Firefly, la que
sea). Cuando estén los archivos, se integran, se optimizan a WebP y se
publican.

## Regla que conviene no romper

**Las fotos de producto NO se generan con IA.** Un pote, una bolsa doypack o
una cuchara dosificadora que salga de un modelo va a mostrar un envase que
Marple no fabrica: distinta forma de tapa, otro sellado, otra proporción. El
cliente que lo vea y lo pida se va a encontrar con que no existe, y el
vendedor queda pagando el plato. Esas ocho fotos son reales y así se quedan.

Lo que sí conviene rehacer es todo lo **ambiental**: los rubros que atendemos,
los procesos y los fondos de sección. Ahí la imagen ilustra una idea, no
promete un producto.

## Contexto de marca (va en todos los prompts)

- Rubro: envases plásticos para la industria alimentaria, Santiago de Chile.
- Colores del sitio: azul petróleo profundo `#0e2533`, azul medio `#2381a4`,
  y los del logo, rojo `#d3312a` y verde `#6dbe45`.
- Tono: industrial limpio, luz natural, nada de brillos exagerados ni look de
  render 3D barato. Fotografía, no ilustración.
- Sin texto, sin logos y sin marcas de otras empresas dentro de la imagen.

---

## 1. Rubros que atendemos — 6 imágenes · 1200×1035 px (proporción 7:6)

**Es lo más urgente.** Hoy estas seis tarjetas muestran fotos prestadas de otra
sección: "Bebidas" tiene una foto del proceso de termoformado, "Panadería" una
bolsa pouch y "Comida preparada" un pote de margarina. O sea, ninguna muestra
su rubro.

Prompt base, cambiando la última frase en cada una:

> Fotografía publicitaria de alimentos en un entorno de producción limpio,
> luz natural suave y lateral, fondo desenfocado en tonos azul petróleo,
> composición cenital o a 45°, aspecto profesional de catálogo industrial,
> sin texto ni logos. Tema: **[RUBRO]**

| Tarjeta | Reemplaza a | Tema para el prompt |
|---|---|---|
| Bebidas | `tf_2-410x354.jpg` | jugos y bebidas frías en envases plásticos transparentes |
| Lácteos y postres | `in_1-410x354.jpg` | yogures, postres y cremas en potes plásticos blancos |
| Panadería | `Bolsa-Pouch_logo-1080x725.jpg` | pan, galletas y masas dulces recién horneadas |
| Conservas y congelados | `lam_1-410x354.jpg` | vegetales congelados y conservas listas para envasar |
| Snacks | `Producto-1-1536x1024.jpg` | frutos secos, papas fritas y snacks salados |
| Comida preparada | `Pote-Mantequilla-Margarina_-1-1024x1024.jpg` | viandas y comida preparada lista para calentar |

## 2. Procesos — 3 imágenes · 820×708 px (proporción 7:6)

Las de hoy miden 410×354, que alcanza justo. Al doble quedan nítidas también
en pantallas retina.

> Fotografía industrial de una planta de envases plásticos, limpia y bien
> iluminada, luz natural fría, operarios de espaldas o sin rostro visible,
> profundidad de campo corta, sin texto ni logos. Tema: **[PROCESO]**

| Tarjeta | Tema para el prompt |
|---|---|
| Termoformado (`tf_2`) | máquina termoformadora dando forma a bandejas plásticas con calor |
| Inyección (`in_1`) | máquina de inyección cerrando el molde, piezas plásticas recién expulsadas |
| Flexible (`lam_1`) | bobinas de film plástico laminado saliendo de la extrusora |

## 3. Fondos de sección — 4 imágenes · 1920×400 px (proporción 24:5)

Son franjas decorativas detrás del título de cada página. Van muy anchas y
bajas, así que conviene pedirlas panorámicas.

> Fotografía panorámica muy apaisada, ambiente industrial de fábrica de
> envases plásticos, tonos azul petróleo y gris, luz suave, poco contraste
> para que un texto blanco encima se lea bien, sin texto ni logos.
> Tema: **[TEMA]**

| Página | Archivo actual | Tema para el prompt |
|---|---|---|
| Nosotros | `Banner-nosotros-1536x320` | planta de producción vista en perspectiva amplia |
| Servicios | `servicios-1536x320` | línea de producción con maquinaria en operación |
| Contacto | `Banner-Contacto-1536x320` | oficinas industriales modernas, entrada de planta |
| Blog | `Banner-blog-890x400` | escritorio con muestras de envases y planos técnicos |

## 4. Banner del home — 1 imagen · 1500×1126 px (proporción 4:3)

El actual (`banner-2.png`) es una composición de productos sobre fondo oscuro
y **funciona bien**. Solo vale la pena rehacerlo si van a cambiar la línea de
productos que se muestra. Si se rehace, tiene que mostrar envases parecidos a
los que Marple fabrica de verdad: bolsa doypack con zipper, potes con tapa,
cucharas dosificadoras y bandejas.

---

## Qué entregar

Los archivos en **PNG o JPG a máxima calidad**, con el nombre del rubro o
proceso al que corresponden. De la compresión me encargo yo: los paso a WebP
—que es lo que sirve el sitio— y quedan pesando entre un 60% y un 90% menos
sin que se note en pantalla.

No hace falta que respeten la medida exacta al pixel: alcanza con que la
proporción sea la correcta y que vengan grandes. Recortar sobra es fácil;
inventar lo que falta, no.
