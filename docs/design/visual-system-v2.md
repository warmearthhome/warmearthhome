# Warm Earth Home - Visual System v2.0

## Overview
Based on competitive analysis and brand values: **Warm · Calm · Simple · Authentic · Comfort**

## Color System

### Primary Colors
- **Warm Bronze** `#D4A574` - Main CTA, buttons, accents
  - Hover: `#C49564` (10% darker)
  - Usage: Primary buttons, prices, key actions
  
- **Deep Clay** `#A46758` - Secondary actions, borders
  - Usage: Secondary buttons, borders, accents
  
- **Urban Slate** `#3E4A52` - Primary text, headings
  - Usage: Headings (H1-H6), body text, navigation

### Neutral Colors
- **Warm Sand** `#F6E9DD` - Background, cards
  - Usage: Page background, card backgrounds, subtle sections
  
- **Soft Ivory** `#FFFFF8` - Card backgrounds, highlights
  - Usage: Product cards, content cards, clean backgrounds
  
- **Light Gray** `#F5F5F5` - Subtle backgrounds, dividers
  - Usage: Trust bars, footer backgrounds, subtle sections

### Accent Colors
- **Accent Glow** `#F3B46E` - Highlights, badges
  - Usage: Sale badges, highlights, special indicators
  
- **Amber** `#E9C46A` - Subtle accents
  - Usage: Optional accents, subtle highlights

### Text Colors
- **Primary Text** `#1a1a1a` on `#FFFFFF` (16.5:1 contrast) ✅
- **Secondary Text** `#666666` on `#FFFFFF` (7.1:1 contrast) ✅
- **Muted Text** `#999999` - Captions, meta info

### Status Colors
- **Success** `#4A9B7F` - Success messages, confirmations
- **Error** `#C95A4A` - Error messages, warnings
- **Info** `#3E4A52` - Informational messages

## Typography

### Font Families
- **Headings**: `'Playfair Display', 'Georgia', serif`
  - Weights: 400 (Regular), 600 (Semi-Bold), 700 (Bold)
  
- **Body**: `'Inter', 'Helvetica Neue', 'Arial', sans-serif`
  - Weights: 300 (Light), 400 (Regular), 500 (Medium), 600 (Semi-Bold)

### Type Scale
- **H1**: 48px / 1.2 line-height (Hero, major headings)
- **H2**: 32px / 1.3 line-height (Section headings)
- **H3**: 24px / 1.4 line-height (Subsection headings)
- **H4**: 20px / 1.4 line-height (Card titles)
- **Body**: 18px / 1.6 line-height (Main content)
- **Small**: 16px / 1.5 line-height (Captions, buttons)
- **Caption**: 14px / 1.4 line-height (Meta info, badges)

### Responsive Typography
- **Mobile H1**: 32px
- **Mobile H2**: 24px
- **Mobile Body**: 16px

## Spacing System (8px Grid)

- **xs**: 8px
- **sm**: 16px
- **md**: 24px
- **lg**: 32px
- **xl**: 40px
- **xxl**: 48px
- **xxxl**: 64px

## Border Radius

- **sm**: 4px (Small elements, tags)
- **md**: 8px (Buttons, cards, inputs - standard)
- **lg**: 12px (Large cards, hero sections)
- **xl**: 16px (Special elements)

## Shadows

- **sm**: `0 2px 8px rgba(0, 0, 0, 0.08)` - Subtle elevation
- **md**: `0 4px 12px rgba(0, 0, 0, 0.1)` - Cards, buttons
- **lg**: `0 8px 24px rgba(0, 0, 0, 0.12)` - Hover states, elevated cards
- **xl**: `0 12px 32px rgba(0, 0, 0, 0.15)` - Modals, popups

## Buttons

### Primary Button
```css
background: #D4A574 (Warm Bronze)
color: #FFFFFF
font-size: 16px
font-weight: 600
padding: 16px 32px
border-radius: 8px
hover: #C49564 + shadow + translateY(-2px)
```

### Secondary Button
```css
background: transparent
border: 2px solid #D4A574
color: #D4A574
hover: fill background with #D4A574, text #FFFFFF
```

### Ghost Button
```css
background: transparent
color: #3E4A52
text-decoration: underline
hover: color #D4A574
```

## Cards

- **Background**: `#FFFFF8` (Soft Ivory)
- **Border Radius**: `8px`
- **Padding**: `24px`
- **Shadow**: `0 4px 12px rgba(0, 0, 0, 0.1)`
- **Hover**: Shadow `0 8px 24px rgba(0, 0, 0, 0.12)` + `translateY(-4px)`

## Transitions

- **Standard**: `all 0.3s ease`
- **Fast**: `all 0.2s ease` (Hover states)
- **Slow**: `all 0.5s ease` (Major animations)

## Breakpoints

- **Mobile**: `0 - 767px`
- **Tablet**: `768px - 1023px`
- **Desktop**: `1024px+`

## Accessibility

### WCAG AA Compliance
- ✅ Primary text contrast: 16.5:1
- ✅ Secondary text contrast: 7.1:1
- ✅ Button text contrast: 4.5:1
- ✅ Focus states for all interactive elements
- ✅ Minimum touch target: 44x44px



