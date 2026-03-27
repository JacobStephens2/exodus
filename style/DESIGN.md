# Design System Specification: Modern Monastic Editorial

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Silent Cloister."** 

This system rejects the frantic, "attention-economy" patterns of modern app design in favor of a digital environment that breathes. It is inspired by the architectural silence of a monastery—where heavy stone meets soft light. We achieve a premium, custom feel by leaning into **intentional asymmetry** and **editorial pacing**. This means using generous white space not just as a gap, but as a structural element that forces the user to slow down and reflect. By avoiding standard "app grids" and using high-contrast typography scales, we create a sense of timelessness and authority.

## 2. Colors & Tonal Depth
The palette is grounded in earthy permanence. We use deep charcoals and muted linens to create a "dimly lit" contemplative atmosphere.

### Surface Hierarchy & The "No-Line" Rule
To maintain a serene, high-end feel, **the use of 1px solid borders for sectioning is strictly prohibited.** Boundaries must be defined through tonal shifts.
*   **Surface Layering:** Treat the UI as a series of heavy, stacked materials. A `surface-container-low` section sitting on a `surface` background provides enough contrast to denote a change in context without the visual "noise" of a line.
*   **The "Deep Well" Effect:** For interactive areas like input fields or discipline trackers, use `surface-container-high` or `surface-dim` to create a "recessed" feeling, as if the element is carved into stone.

### Color Roles
*   **Primary (#371567):** Use sparingly for spiritual significance or active focus states.
*   **Secondary (#775a00):** Reserved for "warmth"—meditation streaks or completed disciplines.
*   **Neutral/Surface:** The backbone of the experience. Use `surface-container-lowest` (#ffffff) only for the highest-priority content cards to make them "glow" against the `surface` (#f9f9f9).

## 3. Typography
The typography is an intentional dialogue between the ancient and the modern.

*   **Display & Headlines (Noto Serif):** These are your "inscriptions." Use `display-lg` and `headline-lg` with generous tracking and line height. Large serif type evokes the tradition of illuminated manuscripts and liturgical texts.
*   **Body & Titles (Inter):** The "workhorse" text. Inter provides a clean, neutral balance to the serif's personality. 
*   **Editorial Scaling:** Don't be afraid of the contrast. A `display-md` header followed by a small, subtle `label-md` creates an editorial look that feels like a premium print journal rather than a generic dashboard.

## 4. Elevation & Depth
In this design system, depth is a matter of weight and light, not "floating" components.

*   **Tonal Layering:** Depth is achieved by "stacking" the surface-container tiers. Place a `surface-container-lowest` card on a `surface-container-low` section to create a soft, natural lift.
*   **Ambient Shadows:** If a floating element (like a FAB) is required, use an extra-diffused shadow: `blur: 24px`, `opacity: 4%`. The shadow color must be a tinted version of `on-surface` (#1a1c1c), never pure black.
*   **The Ghost Border:** For accessibility in forms, use the `outline-variant` token at **15% opacity**. This creates a "suggestion" of a boundary that disappears into the background upon focus.

## 5. Components

### Buttons
*   **Primary:** Solid `primary` background. No rounded-full pill shapes; use `md` (0.375rem) or `sm` (0.125rem) radius to maintain a "grounded" architectural feel.
*   **Secondary/Tertiary:** Use `surface-container-highest` with `on-surface` text. Avoid outlines.

### Cards & Progress Trackers
*   **The Rule of Silence:** Forbid the use of divider lines. Separate list items using `spacing-4` (1.4rem) or subtle background shifts between `surface-container-low` and `surface-container-high`.
*   **Asymmetry:** Place dates or progress percentages in the `label-sm` style, tucked into corners with wide margins to create an artisanal, non-templated look.

### Input Fields
*   **Style:** Minimalist under-lines or subtle "wells" using `surface-variant`.
*   **Focus:** Transition the background color slightly rather than adding a thick high-contrast ring.

### Custom Component: The "Discipline Breath"
A specialized tracker for Lenten disciplines. Instead of a standard checkbox, use a `surface-dim` circle that fills with a soft `secondary` (gold/stone) glow when tapped, accompanied by a slow, meditative fade-in animation.

## 6. Do’s and Don’ts

### Do:
*   **Embrace the Void:** Use `spacing-12` and `spacing-16` to separate major sections. White space is a feature, not a bug.
*   **Align to the Edge:** Use strong left-alignment for text to mimic the "justified-left" look of classic literature.
*   **Use Tonal Transitions:** Shift background colors by one tier (e.g., `surface` to `surface-container-low`) to group related items.

### Don't:
*   **No "App-iness":** Avoid bouncy animations, bright notification dots, or high-gloss buttons.
*   **No Crowding:** If a screen feels "busy," remove an element or increase the spacing scale.
*   **No Pure Black:** Use `tertiary` (#2d2930) or `on-surface` for deep tones to keep the palette organic and soft.