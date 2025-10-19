# Documentação de Design - Casa de Caridade Legião de Oxóssi e Ogum

## Visão Geral do Projeto

Este documento contém as diretrizes de design, padrões e especificações técnicas para o website da Casa de Caridade Legião de Oxóssi e Ogum. O projeto foi desenvolvido com foco em acessibilidade, performance e responsividade.

---

## Identidade Visual

### Paleta de Cores

#### Cores Primárias
- **Verde Oxóssi**: `#2E7D32` - Representa a natureza, fartura e sabedoria
- **Verde Oxóssi Escuro**: `#1B5E20` - Para estados hover e ênfase
- **Vermelho Ogum**: `#C62828` - Simboliza força, determinação e liderança
- **Dourado Sagrado**: `#D4AF37` - Para acentos e elementos de destaque

#### Cores Neutras
- **Texto Principal**: `#1A1A1A` - Preto suave para máxima legibilidade
- **Texto Secundário**: `#666666` - Cinza médio para textos de apoio
- **Texto Claro**: `#B0B0B0` - Para elementos secundários
- **Fundo Claro**: `#FAFAF8` - Branco quente para seções
- **Fundo Cinza**: `#F5F5F5` - Cinza claro para alternância

#### Cores Funcionais
- **WhatsApp**: `#25D366` - Verde oficial do WhatsApp
- **Sucesso**: `#4CAF50`
- **Aviso**: `#FFC107`
- **Erro**: `#F44336`

### Tipografia

#### Fontes Principais
- **Títulos**: Montserrat (Google Fonts)
  - Pesos: 400 (Regular), 600 (SemiBold), 700 (Bold)
- **Corpo do Texto**: Open Sans (Google Fonts)
  - Pesos: 400 (Regular), 600 (SemiBold)

#### Hierarquia de Tamanhos
- **H1**: `clamp(2.5rem, 5vw, 4rem)` - Hero title
- **H2**: `clamp(2rem, 4vw, 3rem)` - Section titles
- **H3**: `clamp(1.5rem, 3vw, 2rem)` - Subsection titles
- **H4**: `clamp(1.25rem, 2.5vw, 1.5rem)` - Card titles
- **Body**: `clamp(1rem, 2vw, 1.125rem)` - Texto principal
- **Small**: `0.875rem` - Textos pequenos

---

## Layout e Grid System

### Breakpoints
```css
/* Mobile First Approach */
Mobile: 320px - 767px (base)
Tablet: 768px - 1023px
Desktop: 1024px - 1439px
Large Desktop: 1440px+
```

### Container
- **Max-width**: 1200px
- **Padding lateral**: 1rem (mobile), 2rem (tablet+)
- **Centralização**: margin auto

### Grid System
- **CSS Grid** para layouts complexos
- **Flexbox** para componentes e alinhamentos
- **Tailwind CSS** para utilitários responsivos

---

## Componentes de Design

### Header/Navegação

#### Estados do Header
1. **Transparente** (Hero section)
   - Background: `rgba(0, 0, 0, 0.1)`
   - Backdrop-filter: `blur(10px)`
   
2. **Sólido** (Após scroll)
   - Background: `rgba(26, 26, 26, 0.95)`
   - Box-shadow: `0 4px 12px rgba(0, 0, 0, 0.12)`

3. **Escondido** (Scroll para baixo)
   - Transform: `translateY(-100%)`

#### Navegação Mobile
- **Hamburguer menu** com animação
- **Overlay** com backdrop blur
- **Acessibilidade**: ARIA labels, ESC para fechar

### Botões

#### Botão Primário
- Background: Verde Oxóssi (`#2E7D32`)
- Text: Branco
- Border: 2px solid Verde Oxóssi
- Hover: Verde Escuro + Transform Y(-2px)
- Focus: Outline dourado + box-shadow

#### Botão Secundário
- Background: Transparente
- Text: Branco (hero) / Verde (outras seções)
- Border: 2px solid
- Hover: Background semi-transparente

#### Botão WhatsApp
- Background: Verde WhatsApp (`#25D366`)
- Efeito shimmer no hover
- Ícone WhatsApp incluso

### Cards

#### Card Padrão
- Background: Branco
- Border-radius: 12px
- Box-shadow: `0 4px 12px rgba(0, 0, 0, 0.08)`
- Hover: Shadow maior + Transform Y(-5px)
- Padding: 2rem (desktop), 1.5rem (mobile)

#### Event Card
- Border-left: 4px solid Verde Oxóssi
- Layout: Flex (data + conteúdo)
- Hover: Transform X(5px)

---

## Seções Específicas

### Hero Section

#### Estrutura
- **Altura**: 100vh mínimo
- **Background**: Imagem de floresta com overlay gradiente
- **Parallax**: Background-attachment fixed (desktop)
- **Overlay**: Gradiente preto com opacidades variadas

#### Conteúdo
- **Logo**: 150px (mobile) / 192px (desktop)
- **Título**: Fonte Montserrat, peso 700
- **Subtítulo**: Tamanho responsivo com clamp()
- **CTAs**: Flex layout, gap 1rem

#### Indicador de Scroll
- **Posição**: Bottom center
- **Animação**: Bounce suave
- **Elemento**: Texto + ícone seta

### About Section

#### Layout
- **Grid**: 3 colunas (desktop), 1 coluna (mobile)
- **Cards**: Centralizados com ícones
- **Ícones**: 64px, cor Verde Oxóssi
- **Espaçamento**: Gap 2rem

### Events Section

#### Event Cards
- **Layout**: Flex horizontal (desktop), vertical (mobile)
- **Data**: Box colorido 80x80px
- **Informações**: Flex-grow para ocupar espaço
- **Bordas**: Border-left Verde Oxóssi

### Contact Section

#### Layout Grid
- **2 colunas**: Informações + Horários
- **Mobile**: 1 coluna stacked
- **Ícones**: 48px, Verde Oxóssi
- **Tabela**: Cabeçalho Verde, linhas zebradas

---

## Acessibilidade (WCAG 2.1 AA/AAA)

### Contraste de Cores
- **Texto normal**: Mínimo 4.5:1 (AA)
- **Texto grande**: Mínimo 3.1:1 (AA)
- **Elementos interativos**: Alto contraste

### Navegação por Teclado
- **Tab order**: Lógico e sequencial
- **Focus indicators**: Visíveis e contrastantes
- **Skip link**: "Pular para conteúdo principal"

### Screen Readers
- **HTML semântico**: Header, nav, main, section, article, aside, footer
- **ARIA labels**: Em elementos interativos
- **Alt text**: Descritivo em todas as imagens
- **Live regions**: Para anúncios dinâmicos

### Área de Toque
- **Mínimo**: 44x44px para todos os elementos interativos
- **Espaçamento**: Adequado entre elementos tocáveis

---

## Animações e Interações

### Princípios
- **Prefer-reduced-motion**: Respeitar preferências do usuário
- **Performance**: GPU-accelerated quando possível
- **Duração**: 0.3s padrão, 0.6s para animações de entrada

### Tipos de Animação

#### Entrada de Elementos
- **Fade in + Translate Y**: Intersection Observer
- **Threshold**: 20% do elemento visível
- **Stagger**: Delay entre elementos similares

#### Hover Effects
- **Transform**: Scale, translateY, translateX
- **Box-shadow**: Sombras maiores
- **Color transitions**: 0.3s ease

#### Loading States
- **Shimmer**: Para botões em carregamento
- **Spinner**: Para operações demoradas
- **Skeleton**: Para conteúdo sendo carregado

---

## Performance

### Otimizações de Imagem
- **Formato**: WebP com fallback JPEG
- **Lazy loading**: Para imagens abaixo da dobra
- **Responsive images**: Múltiplos tamanhos
- **Preload**: Para imagens críticas

### CSS
- **Critical CSS**: Inline no head
- **Non-critical**: Carregamento assíncrono
- **Minificação**: Para produção

### JavaScript
- **Debounce/Throttle**: Para scroll e resize events
- **Intersection Observer**: Para animações e lazy loading
- **Event delegation**: Para elementos dinâmicos

---

## Responsividade

### Abordagem Mobile-First
1. **Design para mobile** primeiro
2. **Progressive enhancement** para telas maiores
3. **Flexbox e Grid** para layouts flexíveis

### Padrões Responsivos

#### Navegação
- **Desktop**: Horizontal inline
- **Mobile**: Hamburguer menu

#### Grid Layouts
- **Desktop**: 3-4 colunas
- **Tablet**: 2 colunas
- **Mobile**: 1 coluna

#### Tipografia
- **Fluid typography**: clamp() para redimensionamento suave
- **Line-height**: Ajustada por breakpoint

---

## Estrutura de Arquivos

```
public/
├── index.html              # Página principal
├── assets/
│   ├── css/
│   │   └── styles.css      # Estilos customizados
│   ├── js/
│   │   └── script.js       # JavaScript principal
│   └── images/
│       ├── logo.png        # Logo da casa
│       ├── floresta-bg.jpg # Background hero
│       └── favicon.ico     # Ícone do site
└── docs/
    └── design-system.md    # Este documento
```

---

## Tecnologias Utilizadas

### Frontend
- **HTML5**: Semântico e acessível
- **CSS3**: Flexbox, Grid, Custom Properties
- **JavaScript ES6+**: Vanilla, modular
- **Tailwind CSS**: Framework utilitário

### Performance
- **Intersection Observer**: Animações e lazy loading
- **Service Worker**: Cache e offline (opcional)
- **Web Vitals**: Monitoramento de performance

### Acessibilidade
- **ARIA**: Labels e roles quando necessário
- **Focus management**: Para interações
- **Screen reader**: Testes com NVDA/JAWS

---

## Manutenção e Atualizações

### CSS Variables
Todas as cores, espaçamentos e outras propriedades estão definidas como CSS custom properties para fácil manutenção.

### Versionamento
- **Semantic versioning** para releases
- **Git flow** para desenvolvimento
- **Testing** antes de cada deploy

### Monitoramento
- **Google Analytics**: Comportamento dos usuários
- **Search Console**: SEO e indexação
- **PageSpeed Insights**: Performance contínua

---

## Checklist de Qualidade

### Antes do Deploy
- [ ] Validação HTML (W3C)
- [ ] Validação CSS (W3C)
- [ ] Teste de acessibilidade (WAVE, axe)
- [ ] Teste em múltiplos navegadores
- [ ] Teste em dispositivos móveis
- [ ] Verificação de performance (Lighthouse)
- [ ] Teste de SEO
- [ ] Verificação de links
- [ ] Teste de formulários

### Pós-Deploy
- [ ] Verificação em produção
- [ ] Teste de velocidade de carregamento
- [ ] Validação de SSL
- [ ] Teste de responsividade
- [ ] Verificação de analytics

---

## Contato e Suporte

Para questões técnicas relacionadas ao design system ou necessidade de atualizações, consulte a documentação ou entre em contato com a equipe de desenvolvimento.

**Saravá! 🌿⚔️**
