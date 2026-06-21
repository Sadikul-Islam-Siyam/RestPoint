import { useState, useEffect } from "react";
import {
  Flame,
  Search,
  Bell,
  Menu,
  X,
  ChevronRight,
  ArrowRight,
  Users,
  MessageSquare,
  Star,
  Eye,
  Heart,
  Clock,
  Sword,
  Shield,
  BookOpen,
  Trophy,
  Zap,
  Globe,
  TrendingUp,
  Play,
} from "lucide-react";

/* ─── data ─────────────────────────────────────────── */

const NAV_LINKS = ["Explore", "Games", "Guilds", "Events", "Lore"];

const STATS = [
  { label: "Pilgrims Online", value: "12,847", icon: Globe },
  { label: "Active Threads", value: "4,291", icon: MessageSquare },
  { label: "Guilds Formed", value: "892", icon: Shield },
  { label: "Games Covered", value: "138", icon: Sword },
];

const GAMES = [
  {
    id: 1,
    title: "Ember's Descent",
    genre: "Souls-like",
    members: "21.5k",
    posts: "7.3k",
    rating: 4.9,
    hot: true,
    img: "https://images.unsplash.com/photo-1765294021016-f98fa390a506?w=800&h=560&fit=crop&auto=format",
    accentHex: "#8b2a0a",
  },
  {
    id: 2,
    title: "Ashen Covenant",
    genre: "Action RPG",
    members: "14.2k",
    posts: "3.8k",
    rating: 4.8,
    hot: true,
    img: "https://images.unsplash.com/photo-1768741876785-268ebaaddc03?w=800&h=560&fit=crop&auto=format",
    accentHex: "#6b1a1a",
  },
  {
    id: 3,
    title: "Veilborn",
    genre: "Gothic Horror",
    members: "8.1k",
    posts: "2.9k",
    rating: 4.7,
    hot: false,
    img: "https://images.unsplash.com/photo-1762452712451-33780c18a745?w=800&h=560&fit=crop&auto=format",
    accentHex: "#2a1a4a",
  },
  {
    id: 4,
    title: "The Shattered Throne",
    genre: "Dark Fantasy",
    members: "6.3k",
    posts: "1.4k",
    rating: 4.6,
    hot: false,
    img: "https://images.unsplash.com/photo-1511200903586-f88075762629?w=800&h=560&fit=crop&auto=format",
    accentHex: "#1a2a3a",
  },
  {
    id: 5,
    title: "Ironveil Chronicles",
    genre: "Open World",
    members: "9.7k",
    posts: "2.1k",
    rating: 4.5,
    hot: false,
    img: "https://images.unsplash.com/photo-1767779670896-a02bc4f0b5e3?w=800&h=560&fit=crop&auto=format",
    accentHex: "#1a3a1a",
  },
  {
    id: 6,
    title: "Grimstone Pact",
    genre: "Strategy RPG",
    members: "5.4k",
    posts: "1.1k",
    rating: 4.4,
    hot: false,
    img: "https://images.unsplash.com/photo-1761668599140-217fd197d204?w=800&h=560&fit=crop&auto=format",
    accentHex: "#2a2a1a",
  },
];

const FEATURED_POST = {
  title: "The Great Covenant War of Season XII — A Full Chronicle",
  excerpt:
    "Four guilds, one shattered throne, and forty-three days of the most coordinated PvP campaign in RestPoint history. We sat down with the generals of each faction to piece together what really happened.",
  game: "Ember's Descent",
  author: "Ashen_Knight",
  authorRank: "Bearer of the Flame",
  time: "2 hours ago",
  reads: "12.4k",
  comments: 347,
  img: "https://images.unsplash.com/photo-1470549584009-d347338fc0ff?w=900&h=600&fit=crop&auto=format",
};

const SIDE_POSTS = [
  {
    id: 1,
    flair: "Build Theory",
    flairColor: "#cf7c1a",
    title: "Optimal bonfire build for NG+7 — all 12 covenants tested",
    game: "Ember's Descent",
    author: "PhantomBlade_IX",
    time: "4h ago",
    comments: 147,
    likes: 284,
  },
  {
    id: 2,
    flair: "Lore & Theory",
    flairColor: "#7a5cb8",
    title: "Who built the Shattered Throne — and why the lore lies to you",
    game: "The Shattered Throne",
    author: "LoreMasterVex",
    time: "6h ago",
    comments: 93,
    likes: 176,
  },
  {
    id: 3,
    flair: "Guild Recruitment",
    flairColor: "#3a8a4a",
    title: "Ironveil Remnants now recruiting — 200+ members, weekly raids",
    game: "Ironveil Chronicles",
    author: "GuildmasterResh",
    time: "9h ago",
    comments: 58,
    likes: 91,
  },
  {
    id: 4,
    flair: "News",
    flairColor: "#b83025",
    title: "Ashen Covenant patch 1.4.2 — sweeping covenant rebalance incoming",
    game: "Ashen Covenant",
    author: "DevWatch_Sorn",
    time: "12h ago",
    comments: 211,
    likes: 432,
  },
];

const TESTIMONIALS = [
  {
    quote: "The only forum where the lore discussions are as deep as the games themselves.",
    author: "Mordecai_IX",
    rank: "Lorekeeper · 3 years",
    avatar: "M",
  },
  {
    quote: "Found my guild here. Three years later we're still clearing endgame content together every week.",
    author: "SilentBlade_V",
    rank: "Ember Knight · 3 years",
    avatar: "S",
  },
  {
    quote: "RestPoint has the best build database in the soulslike community. Period.",
    author: "RavenWeld",
    rank: "Ashen Pilgrim · 2 years",
    avatar: "R",
  },
];

/* ─── component ─────────────────────────────────────── */

export default function App() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [activeGame, setActiveGame] = useState<number | null>(null);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 40);
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const amber = "#cf7c1a";
  const amberGlow = "rgba(207,124,26,0.18)";

  return (
    <div
      style={{
        background: "#090805",
        color: "#ede5d0",
        fontFamily: "'Outfit', system-ui, sans-serif",
        minHeight: "100vh",
      }}
    >
      {/* ── NAVBAR ────────────────────────────────────── */}
      <header
        style={{
          position: "fixed",
          top: 0,
          left: 0,
          right: 0,
          zIndex: 100,
          transition: "background 0.4s ease, border-color 0.4s ease, backdrop-filter 0.4s ease",
          background: scrolled
            ? "rgba(9,8,5,0.88)"
            : "transparent",
          backdropFilter: scrolled ? "blur(20px) saturate(1.4)" : "none",
          borderBottom: scrolled
            ? "1px solid rgba(207,124,26,0.12)"
            : "1px solid transparent",
        }}
      >
        <div
          style={{
            maxWidth: "1280px",
            margin: "0 auto",
            padding: "0 2.5rem",
            height: "72px",
            display: "flex",
            alignItems: "center",
            gap: "2rem",
          }}
        >
          {/* Logo */}
          <a
            href="#"
            style={{
              display: "flex",
              alignItems: "center",
              gap: "10px",
              textDecoration: "none",
              flexShrink: 0,
            }}
          >
            {/* Flame mark */}
            <div style={{ position: "relative", width: 32, height: 36 }}>
              <svg viewBox="0 0 32 36" width={32} height={36} fill="none">
                <ellipse cx="16" cy="33" rx="7" ry="2" fill={amber} opacity="0.22" />
                <path
                  d="M16 34C9.5 29,7.5 21,12 15C11 20,15 22,17 19C14.5 25,19.5 27,21.5 22.5C24 19,22.5 13.5,19 10.5C23.5 13,27 19.5,23 25.5C25 23,25.5 18.5,23 15.5C26.5 19,27 25.5,23 30C23.5 31.5,21 34,16 34Z"
                  fill="url(#ng)"
                />
                <rect x="9" y="32" width="14" height="2.5" rx="1.25" fill="#5a2c08" />
                <defs>
                  <linearGradient id="ng" x1="16" y1="34" x2="16" y2="10" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stopColor="#a05010" />
                    <stop offset="45%" stopColor="#cf7c1a" />
                    <stop offset="85%" stopColor="#f0c040" />
                    <stop offset="100%" stopColor="#fff8c0" stopOpacity="0.85" />
                  </linearGradient>
                </defs>
              </svg>
              <div
                style={{
                  position: "absolute",
                  inset: 0,
                  borderRadius: "50%",
                  background: "radial-gradient(circle at 50% 60%, rgba(207,124,26,0.28) 0%, transparent 70%)",
                }}
              />
            </div>
            <div>
              <div
                style={{
                  fontFamily: "'Cinzel', serif",
                  fontSize: "18px",
                  fontWeight: 700,
                  letterSpacing: "0.16em",
                  color: amber,
                  textShadow: "0 0 28px rgba(207,124,26,0.5)",
                  lineHeight: 1,
                }}
              >
                RESTPOINT
              </div>
              <div
                style={{
                  fontSize: "9px",
                  letterSpacing: "0.25em",
                  color: "#5a4e38",
                  textTransform: "uppercase",
                  fontFamily: "'JetBrains Mono', monospace",
                  marginTop: 2,
                }}
              >
                Gaming Sanctuary
              </div>
            </div>
          </a>

          {/* Nav links — desktop */}
          <nav
            style={{
              display: "flex",
              alignItems: "center",
              gap: "0.25rem",
              marginLeft: "1.5rem",
              flex: 1,
            }}
            className="hidden-mobile"
          >
            {NAV_LINKS.map((link) => (
              <a
                key={link}
                href="#"
                style={{
                  padding: "6px 14px",
                  fontSize: "13px",
                  fontFamily: "'Cinzel', serif",
                  letterSpacing: "0.08em",
                  color: "#8a7a62",
                  textDecoration: "none",
                  borderRadius: "6px",
                  transition: "color 0.2s, background 0.2s",
                }}
                onMouseEnter={(e) => {
                  (e.currentTarget as HTMLElement).style.color = "#ede5d0";
                  (e.currentTarget as HTMLElement).style.background = "rgba(207,124,26,0.07)";
                }}
                onMouseLeave={(e) => {
                  (e.currentTarget as HTMLElement).style.color = "#8a7a62";
                  (e.currentTarget as HTMLElement).style.background = "transparent";
                }}
              >
                {link}
              </a>
            ))}
          </nav>

          {/* Right controls */}
          <div style={{ display: "flex", alignItems: "center", gap: "10px", marginLeft: "auto" }}>
            <button
              style={{
                background: "transparent",
                border: "none",
                cursor: "pointer",
                padding: "8px",
                borderRadius: "8px",
                color: "#6a5d49",
                transition: "color 0.2s, background 0.2s",
              }}
              onMouseEnter={(e) => {
                (e.currentTarget as HTMLElement).style.color = "#ede5d0";
                (e.currentTarget as HTMLElement).style.background = "rgba(255,255,255,0.05)";
              }}
              onMouseLeave={(e) => {
                (e.currentTarget as HTMLElement).style.color = "#6a5d49";
                (e.currentTarget as HTMLElement).style.background = "transparent";
              }}
            >
              <Search size={18} />
            </button>

            <button
              style={{
                position: "relative",
                background: "transparent",
                border: "none",
                cursor: "pointer",
                padding: "8px",
                borderRadius: "8px",
                color: "#6a5d49",
                transition: "color 0.2s, background 0.2s",
              }}
              onMouseEnter={(e) => {
                (e.currentTarget as HTMLElement).style.color = "#ede5d0";
                (e.currentTarget as HTMLElement).style.background = "rgba(255,255,255,0.05)";
              }}
              onMouseLeave={(e) => {
                (e.currentTarget as HTMLElement).style.color = "#6a5d49";
                (e.currentTarget as HTMLElement).style.background = "transparent";
              }}
            >
              <Bell size={18} />
              <span
                style={{
                  position: "absolute",
                  top: 6,
                  right: 6,
                  width: 7,
                  height: 7,
                  borderRadius: "50%",
                  background: amber,
                  boxShadow: `0 0 8px ${amber}`,
                }}
              />
            </button>

            <a
              href="#"
              style={{
                padding: "8px 20px",
                fontSize: "12px",
                fontFamily: "'Cinzel', serif",
                fontWeight: 600,
                letterSpacing: "0.1em",
                background: `linear-gradient(135deg, #cf7c1a 0%, #9a5510 100%)`,
                color: "#fff8ec",
                textDecoration: "none",
                borderRadius: "6px",
                boxShadow: "0 0 24px rgba(207,124,26,0.25)",
                transition: "opacity 0.2s, box-shadow 0.2s",
              }}
              onMouseEnter={(e) => {
                (e.currentTarget as HTMLElement).style.opacity = "0.88";
                (e.currentTarget as HTMLElement).style.boxShadow = "0 0 36px rgba(207,124,26,0.4)";
              }}
              onMouseLeave={(e) => {
                (e.currentTarget as HTMLElement).style.opacity = "1";
                (e.currentTarget as HTMLElement).style.boxShadow = "0 0 24px rgba(207,124,26,0.25)";
              }}
            >
              Join the Sanctum
            </a>

            {/* Hamburger */}
            <button
              onClick={() => setMenuOpen(!menuOpen)}
              style={{
                display: "none",
                background: "transparent",
                border: "none",
                cursor: "pointer",
                color: "#ede5d0",
                padding: "6px",
              }}
              className="show-mobile"
            >
              {menuOpen ? <X size={22} /> : <Menu size={22} />}
            </button>
          </div>
        </div>

        {/* Mobile menu */}
        {menuOpen && (
          <div
            style={{
              background: "rgba(9,8,5,0.97)",
              borderTop: "1px solid rgba(207,124,26,0.12)",
              padding: "1.5rem 2.5rem",
              display: "flex",
              flexDirection: "column",
              gap: "4px",
            }}
          >
            {NAV_LINKS.map((link) => (
              <a
                key={link}
                href="#"
                style={{
                  padding: "10px 0",
                  fontFamily: "'Cinzel', serif",
                  fontSize: "14px",
                  letterSpacing: "0.1em",
                  color: "#8a7a62",
                  textDecoration: "none",
                  borderBottom: "1px solid rgba(207,124,26,0.06)",
                }}
              >
                {link}
              </a>
            ))}
          </div>
        )}
      </header>

      {/* ── HERO ──────────────────────────────────────── */}
      <section
        style={{
          position: "relative",
          minHeight: "100vh",
          display: "flex",
          alignItems: "center",
          overflow: "hidden",
        }}
      >
        {/* Background image */}
        <img
          src="https://images.unsplash.com/photo-1641667838410-b257ca266e38?w=1800&h=1100&fit=crop&auto=format"
          alt="Dark atmospheric forest — hero background"
          style={{
            position: "absolute",
            inset: 0,
            width: "100%",
            height: "100%",
            objectFit: "cover",
            objectPosition: "center 30%",
            filter: "brightness(0.35) saturate(0.7)",
          }}
        />

        {/* Gradient overlays */}
        <div
          style={{
            position: "absolute",
            inset: 0,
            background:
              "linear-gradient(180deg, rgba(9,8,5,0.5) 0%, rgba(9,8,5,0.2) 40%, rgba(9,8,5,0.85) 100%)",
          }}
        />
        <div
          style={{
            position: "absolute",
            inset: 0,
            background:
              "radial-gradient(ellipse 70% 60% at 50% 70%, rgba(207,124,26,0.07) 0%, transparent 70%)",
          }}
        />
        {/* Left vignette */}
        <div
          style={{
            position: "absolute",
            inset: 0,
            background: "linear-gradient(90deg, rgba(9,8,5,0.7) 0%, transparent 50%)",
          }}
        />

        {/* Decorative ember particles (CSS only) */}
        {[...Array(5)].map((_, i) => (
          <div
            key={i}
            style={{
              position: "absolute",
              width: 3 + i * 1.5 + "px",
              height: 3 + i * 1.5 + "px",
              borderRadius: "50%",
              background: amber,
              boxShadow: `0 0 ${8 + i * 4}px ${amber}`,
              left: `${15 + i * 16}%`,
              bottom: `${28 + i * 8}%`,
              opacity: 0.5 - i * 0.07,
              animation: `float-${i} ${4 + i}s ease-in-out infinite alternate`,
            }}
          />
        ))}

        <div
          style={{
            position: "relative",
            maxWidth: "1280px",
            margin: "0 auto",
            padding: "0 2.5rem",
            width: "100%",
            paddingTop: "8rem",
            paddingBottom: "6rem",
          }}
        >
          {/* Eyebrow */}
          <div
            style={{
              display: "inline-flex",
              alignItems: "center",
              gap: "8px",
              padding: "6px 16px",
              borderRadius: "4px",
              background: "rgba(207,124,26,0.12)",
              border: "1px solid rgba(207,124,26,0.28)",
              marginBottom: "2rem",
            }}
          >
            <Flame size={12} color={amber} />
            <span
              style={{
                fontFamily: "'JetBrains Mono', monospace",
                fontSize: "10px",
                letterSpacing: "0.22em",
                textTransform: "uppercase",
                color: amber,
              }}
            >
              The Sanctuary is Lit
            </span>
          </div>

          {/* Main headline */}
          <h1
            style={{
              fontFamily: "'Cinzel', serif",
              fontSize: "clamp(2.8rem, 7vw, 6.5rem)",
              fontWeight: 900,
              lineHeight: 1.05,
              letterSpacing: "-0.01em",
              color: "#f0e8d4",
              textShadow: "0 4px 40px rgba(0,0,0,0.8)",
              maxWidth: "800px",
              marginBottom: "1.5rem",
            }}
          >
            Where Flames
            <br />
            <span
              style={{
                color: amber,
                textShadow: `0 0 60px rgba(207,124,26,0.5), 0 4px 40px rgba(0,0,0,0.8)`,
              }}
            >
              Never Die
            </span>
          </h1>

          {/* Sub-headline */}
          <p
            style={{
              fontSize: "clamp(1rem, 2vw, 1.25rem)",
              color: "#8a7a62",
              lineHeight: 1.7,
              maxWidth: "520px",
              marginBottom: "2.5rem",
              fontWeight: 300,
            }}
          >
            RestPoint is the dark RPG community for those who embrace the
            struggle. Discover guilds, deep lore, and elite builds — forged in
            the embers of a thousand fallen Undead.
          </p>

          {/* CTAs */}
          <div style={{ display: "flex", alignItems: "center", gap: "14px", flexWrap: "wrap" }}>
            <a
              href="#"
              style={{
                display: "inline-flex",
                alignItems: "center",
                gap: "10px",
                padding: "14px 32px",
                fontFamily: "'Cinzel', serif",
                fontSize: "13px",
                fontWeight: 600,
                letterSpacing: "0.1em",
                background: "linear-gradient(135deg, #cf7c1a 0%, #9a5510 100%)",
                color: "#fff8ec",
                textDecoration: "none",
                borderRadius: "6px",
                boxShadow: "0 8px 40px rgba(207,124,26,0.3), 0 2px 8px rgba(0,0,0,0.5)",
                transition: "transform 0.2s, box-shadow 0.2s",
              }}
              onMouseEnter={(e) => {
                (e.currentTarget as HTMLElement).style.transform = "translateY(-2px)";
                (e.currentTarget as HTMLElement).style.boxShadow = "0 12px 48px rgba(207,124,26,0.45), 0 2px 8px rgba(0,0,0,0.5)";
              }}
              onMouseLeave={(e) => {
                (e.currentTarget as HTMLElement).style.transform = "translateY(0)";
                (e.currentTarget as HTMLElement).style.boxShadow = "0 8px 40px rgba(207,124,26,0.3), 0 2px 8px rgba(0,0,0,0.5)";
              }}
            >
              Light Your Bonfire
              <ArrowRight size={16} />
            </a>
            <a
              href="#"
              style={{
                display: "inline-flex",
                alignItems: "center",
                gap: "8px",
                padding: "14px 28px",
                fontFamily: "'Cinzel', serif",
                fontSize: "13px",
                fontWeight: 500,
                letterSpacing: "0.08em",
                background: "rgba(255,255,255,0.05)",
                color: "#c8b898",
                textDecoration: "none",
                borderRadius: "6px",
                border: "1px solid rgba(255,255,255,0.1)",
                transition: "background 0.2s, color 0.2s",
              }}
              onMouseEnter={(e) => {
                (e.currentTarget as HTMLElement).style.background = "rgba(255,255,255,0.08)";
                (e.currentTarget as HTMLElement).style.color = "#ede5d0";
              }}
              onMouseLeave={(e) => {
                (e.currentTarget as HTMLElement).style.background = "rgba(255,255,255,0.05)";
                (e.currentTarget as HTMLElement).style.color = "#c8b898";
              }}
            >
              <Play size={14} />
              Watch the Trailer
            </a>
          </div>

          {/* Live count */}
          <div
            style={{
              marginTop: "3.5rem",
              display: "flex",
              alignItems: "center",
              gap: "10px",
            }}
          >
            {/* Avatar stack */}
            <div style={{ display: "flex" }}>
              {["AK", "LV", "GR", "PB", "DS"].map((initials, i) => (
                <div
                  key={initials}
                  style={{
                    width: 32,
                    height: 32,
                    borderRadius: "50%",
                    background: `linear-gradient(135deg, hsl(${20 + i * 30},60%,28%), hsl(${20 + i * 30},50%,18%))`,
                    border: "2px solid #090805",
                    marginLeft: i === 0 ? 0 : -10,
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    fontSize: "9px",
                    fontFamily: "'Cinzel', serif",
                    fontWeight: 600,
                    color: "#f0e0c0",
                    zIndex: 5 - i,
                    position: "relative",
                  }}
                >
                  {initials}
                </div>
              ))}
            </div>
            <div>
              <p style={{ fontSize: "13px", color: "#8a7a62", lineHeight: 1.2 }}>
                <span style={{ color: "#ede5d0", fontWeight: 500 }}>12,847 pilgrims</span>{" "}
                resting at the bonfire right now
              </p>
            </div>
          </div>
        </div>

        {/* Scroll hint */}
        <div
          style={{
            position: "absolute",
            bottom: "2rem",
            left: "50%",
            transform: "translateX(-50%)",
            display: "flex",
            flexDirection: "column",
            alignItems: "center",
            gap: "6px",
            opacity: 0.4,
          }}
        >
          <div
            style={{
              width: 1,
              height: 48,
              background: "linear-gradient(180deg, transparent, rgba(207,124,26,0.8))",
            }}
          />
          <span
            style={{
              fontFamily: "'JetBrains Mono', monospace",
              fontSize: "9px",
              letterSpacing: "0.2em",
              color: amber,
              textTransform: "uppercase",
            }}
          >
            Descend
          </span>
        </div>
      </section>

      {/* ── STATS STRIP ───────────────────────────────── */}
      <section
        style={{
          borderTop: "1px solid rgba(207,124,26,0.1)",
          borderBottom: "1px solid rgba(207,124,26,0.1)",
          background: "rgba(207,124,26,0.03)",
        }}
      >
        <div
          style={{
            maxWidth: "1280px",
            margin: "0 auto",
            padding: "0 2.5rem",
            display: "grid",
            gridTemplateColumns: "repeat(4,1fr)",
            gap: "0",
          }}
        >
          {STATS.map((s, i) => (
            <div
              key={s.label}
              style={{
                padding: "2.5rem 2rem",
                display: "flex",
                flexDirection: "column",
                gap: "8px",
                borderRight:
                  i < STATS.length - 1 ? "1px solid rgba(207,124,26,0.1)" : "none",
              }}
            >
              <s.icon size={16} color={amber} style={{ opacity: 0.7 }} />
              <div
                style={{
                  fontFamily: "'JetBrains Mono', monospace",
                  fontSize: "clamp(1.6rem, 3vw, 2.4rem)",
                  fontWeight: 500,
                  color: "#ede5d0",
                  lineHeight: 1,
                }}
              >
                {s.value}
              </div>
              <div
                style={{
                  fontSize: "12px",
                  color: "#6a5d49",
                  letterSpacing: "0.05em",
                  textTransform: "uppercase",
                  fontFamily: "'JetBrains Mono', monospace",
                }}
              >
                {s.label}
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* ── GAME SANCTUARIES ──────────────────────────── */}
      <section style={{ padding: "7rem 0" }}>
        <div
          style={{ maxWidth: "1280px", margin: "0 auto", padding: "0 2.5rem" }}
        >
          {/* Section heading */}
          <div
            style={{
              display: "flex",
              alignItems: "flex-end",
              justifyContent: "space-between",
              marginBottom: "3.5rem",
              flexWrap: "wrap",
              gap: "1rem",
            }}
          >
            <div>
              <div
                style={{
                  fontFamily: "'JetBrains Mono', monospace",
                  fontSize: "10px",
                  letterSpacing: "0.25em",
                  textTransform: "uppercase",
                  color: amber,
                  marginBottom: "0.75rem",
                }}
              >
                ── Browse Communities
              </div>
              <h2
                style={{
                  fontFamily: "'Cinzel', serif",
                  fontSize: "clamp(1.8rem, 4vw, 3rem)",
                  fontWeight: 700,
                  color: "#f0e8d4",
                  lineHeight: 1.1,
                }}
              >
                Game Sanctuaries
              </h2>
              <p
                style={{
                  marginTop: "0.75rem",
                  color: "#6a5d49",
                  fontSize: "15px",
                  maxWidth: "480px",
                  lineHeight: 1.6,
                }}
              >
                Find your kin. Every title has its own corner of the bonfire.
              </p>
            </div>
            <a
              href="#"
              style={{
                display: "inline-flex",
                alignItems: "center",
                gap: "6px",
                fontFamily: "'Cinzel', serif",
                fontSize: "12px",
                letterSpacing: "0.08em",
                color: amber,
                textDecoration: "none",
                padding: "8px 16px",
                borderRadius: "6px",
                border: "1px solid rgba(207,124,26,0.25)",
                transition: "background 0.2s",
              }}
              onMouseEnter={(e) => ((e.currentTarget as HTMLElement).style.background = amberGlow)}
              onMouseLeave={(e) => ((e.currentTarget as HTMLElement).style.background = "transparent")}
            >
              All Games <ChevronRight size={14} />
            </a>
          </div>

          {/* Grid */}
          <div
            style={{
              display: "grid",
              gridTemplateColumns: "repeat(3, 1fr)",
              gap: "1.5rem",
            }}
          >
            {GAMES.map((game) => (
              <div
                key={game.id}
                onMouseEnter={() => setActiveGame(game.id)}
                onMouseLeave={() => setActiveGame(null)}
                style={{
                  borderRadius: "10px",
                  overflow: "hidden",
                  background: "#131008",
                  border: `1px solid ${
                    activeGame === game.id
                      ? "rgba(207,124,26,0.35)"
                      : "rgba(207,124,26,0.1)"
                  }`,
                  boxShadow:
                    activeGame === game.id
                      ? "0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(207,124,26,0.2)"
                      : "0 4px 24px rgba(0,0,0,0.4)",
                  transform: activeGame === game.id ? "translateY(-6px)" : "translateY(0)",
                  transition: "all 0.35s cubic-bezier(0.22,1,0.36,1)",
                  cursor: "pointer",
                }}
              >
                {/* Image */}
                <div
                  style={{
                    position: "relative",
                    height: "200px",
                    background: game.accentHex,
                    overflow: "hidden",
                  }}
                >
                  <img
                    src={game.img}
                    alt={`${game.title} game art`}
                    style={{
                      width: "100%",
                      height: "100%",
                      objectFit: "cover",
                      transform: activeGame === game.id ? "scale(1.06)" : "scale(1)",
                      transition: "transform 0.6s cubic-bezier(0.22,1,0.36,1)",
                    }}
                  />
                  <div
                    style={{
                      position: "absolute",
                      inset: 0,
                      background: `linear-gradient(180deg, ${game.accentHex}44 0%, rgba(10,8,4,0.9) 100%)`,
                    }}
                  />
                  {game.hot && (
                    <div
                      style={{
                        position: "absolute",
                        top: "14px",
                        right: "14px",
                        display: "flex",
                        alignItems: "center",
                        gap: "5px",
                        padding: "4px 10px",
                        borderRadius: "4px",
                        background: "rgba(207,124,26,0.92)",
                        color: "#1a0800",
                        fontFamily: "'JetBrains Mono', monospace",
                        fontSize: "9px",
                        fontWeight: 700,
                        letterSpacing: "0.15em",
                        textTransform: "uppercase",
                      }}
                    >
                      <Flame size={10} />
                      Trending
                    </div>
                  )}
                  <div
                    style={{
                      position: "absolute",
                      bottom: "16px",
                      left: "18px",
                    }}
                  >
                    <div
                      style={{
                        fontFamily: "'JetBrains Mono', monospace",
                        fontSize: "9px",
                        letterSpacing: "0.18em",
                        textTransform: "uppercase",
                        color: amber,
                        marginBottom: "4px",
                      }}
                    >
                      {game.genre}
                    </div>
                    <h3
                      style={{
                        fontFamily: "'Cinzel', serif",
                        fontSize: "16px",
                        fontWeight: 600,
                        color: "#f0e8d4",
                        lineHeight: 1.2,
                      }}
                    >
                      {game.title}
                    </h3>
                  </div>
                </div>

                {/* Card body */}
                <div
                  style={{
                    padding: "16px 18px",
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "space-between",
                  }}
                >
                  <div style={{ display: "flex", gap: "20px" }}>
                    <div style={{ display: "flex", alignItems: "center", gap: "6px" }}>
                      <Users size={13} color="#4a3f2e" />
                      <span
                        style={{
                          fontFamily: "'JetBrains Mono', monospace",
                          fontSize: "12px",
                          color: "#8a7a62",
                        }}
                      >
                        {game.members}
                      </span>
                    </div>
                    <div style={{ display: "flex", alignItems: "center", gap: "6px" }}>
                      <MessageSquare size={13} color="#4a3f2e" />
                      <span
                        style={{
                          fontFamily: "'JetBrains Mono', monospace",
                          fontSize: "12px",
                          color: "#8a7a62",
                        }}
                      >
                        {game.posts}
                      </span>
                    </div>
                  </div>
                  <div style={{ display: "flex", alignItems: "center", gap: "5px" }}>
                    <Star size={12} color="#e8a22a" fill="#e8a22a" />
                    <span
                      style={{
                        fontFamily: "'JetBrains Mono', monospace",
                        fontSize: "12px",
                        color: "#e8a22a",
                      }}
                    >
                      {game.rating}
                    </span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── THE CHRONICLE ─────────────────────────────── */}
      <section
        style={{
          padding: "7rem 0",
          borderTop: "1px solid rgba(207,124,26,0.08)",
          background:
            "radial-gradient(ellipse 80% 50% at 50% 0%, rgba(207,124,26,0.04) 0%, transparent 70%)",
        }}
      >
        <div
          style={{ maxWidth: "1280px", margin: "0 auto", padding: "0 2.5rem" }}
        >
          {/* Heading */}
          <div style={{ marginBottom: "3.5rem" }}>
            <div
              style={{
                fontFamily: "'JetBrains Mono', monospace",
                fontSize: "10px",
                letterSpacing: "0.25em",
                textTransform: "uppercase",
                color: amber,
                marginBottom: "0.75rem",
              }}
            >
              ── Latest from the Community
            </div>
            <h2
              style={{
                fontFamily: "'Cinzel', serif",
                fontSize: "clamp(1.8rem, 4vw, 3rem)",
                fontWeight: 700,
                color: "#f0e8d4",
                lineHeight: 1.1,
              }}
            >
              The Chronicle
            </h2>
          </div>

          {/* Asymmetric layout: large featured left + list right */}
          <div
            style={{
              display: "grid",
              gridTemplateColumns: "1fr 420px",
              gap: "2.5rem",
              alignItems: "start",
            }}
          >
            {/* Featured post */}
            <a
              href="#"
              style={{
                display: "block",
                borderRadius: "10px",
                overflow: "hidden",
                background: "#131008",
                border: "1px solid rgba(207,124,26,0.12)",
                textDecoration: "none",
                transition: "border-color 0.3s, box-shadow 0.3s, transform 0.3s",
              }}
              onMouseEnter={(e) => {
                const el = e.currentTarget as HTMLElement;
                el.style.borderColor = "rgba(207,124,26,0.3)";
                el.style.transform = "translateY(-4px)";
                el.style.boxShadow = "0 24px 64px rgba(0,0,0,0.5)";
              }}
              onMouseLeave={(e) => {
                const el = e.currentTarget as HTMLElement;
                el.style.borderColor = "rgba(207,124,26,0.12)";
                el.style.transform = "translateY(0)";
                el.style.boxShadow = "none";
              }}
            >
              {/* Image */}
              <div style={{ position: "relative", height: "280px", background: "#1a1208", overflow: "hidden" }}>
                <img
                  src={FEATURED_POST.img}
                  alt="Featured article: bonfire"
                  style={{ width: "100%", height: "100%", objectFit: "cover" }}
                />
                <div
                  style={{
                    position: "absolute",
                    inset: 0,
                    background:
                      "linear-gradient(180deg, rgba(9,8,5,0.2) 0%, rgba(9,8,5,0.8) 100%)",
                  }}
                />
                <div
                  style={{
                    position: "absolute",
                    top: "16px",
                    left: "16px",
                    display: "inline-flex",
                    alignItems: "center",
                    gap: "6px",
                    padding: "5px 12px",
                    borderRadius: "4px",
                    background: "rgba(207,124,26,0.18)",
                    border: "1px solid rgba(207,124,26,0.3)",
                    fontFamily: "'JetBrains Mono', monospace",
                    fontSize: "9px",
                    letterSpacing: "0.18em",
                    color: amber,
                    textTransform: "uppercase",
                  }}
                >
                  <Flame size={10} />
                  Featured
                </div>
              </div>

              <div style={{ padding: "2rem" }}>
                <div style={{ display: "flex", alignItems: "center", gap: "10px", marginBottom: "1rem" }}>
                  <span
                    style={{
                      fontSize: "11px",
                      padding: "3px 10px",
                      borderRadius: "4px",
                      background: "rgba(207,124,26,0.1)",
                      border: "1px solid rgba(207,124,26,0.18)",
                      color: "#a06818",
                      fontFamily: "'JetBrains Mono', monospace",
                    }}
                  >
                    {FEATURED_POST.game}
                  </span>
                </div>
                <h3
                  style={{
                    fontFamily: "'Cinzel', serif",
                    fontSize: "clamp(1rem, 2vw, 1.35rem)",
                    fontWeight: 600,
                    color: "#f0e8d4",
                    lineHeight: 1.4,
                    marginBottom: "0.875rem",
                  }}
                >
                  {FEATURED_POST.title}
                </h3>
                <p
                  style={{
                    color: "#6a5d49",
                    fontSize: "14px",
                    lineHeight: 1.75,
                    marginBottom: "1.5rem",
                  }}
                >
                  {FEATURED_POST.excerpt}
                </p>
                <div
                  style={{
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "space-between",
                    paddingTop: "1rem",
                    borderTop: "1px solid rgba(207,124,26,0.08)",
                  }}
                >
                  <div style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                    <div
                      style={{
                        width: 32,
                        height: 32,
                        borderRadius: "50%",
                        background: "linear-gradient(135deg, #8b3a0a, #5c2205)",
                        display: "flex",
                        alignItems: "center",
                        justifyContent: "center",
                        fontSize: "11px",
                        fontFamily: "'Cinzel', serif",
                        fontWeight: 600,
                        color: "#f5e8c0",
                      }}
                    >
                      AK
                    </div>
                    <div>
                      <p style={{ fontSize: "12px", color: "#c8b898", fontWeight: 500 }}>
                        {FEATURED_POST.author}
                      </p>
                      <p style={{ fontSize: "11px", color: "#4a3f2e" }}>
                        {FEATURED_POST.authorRank}
                      </p>
                    </div>
                  </div>
                  <div style={{ display: "flex", gap: "16px" }}>
                    {[
                      { icon: Eye, val: FEATURED_POST.reads },
                      { icon: MessageSquare, val: FEATURED_POST.comments },
                    ].map(({ icon: Icon, val }) => (
                      <span
                        key={String(val)}
                        style={{
                          display: "flex",
                          alignItems: "center",
                          gap: "5px",
                          fontFamily: "'JetBrains Mono', monospace",
                          fontSize: "12px",
                          color: "#4a3f2e",
                        }}
                      >
                        <Icon size={13} />
                        {val}
                      </span>
                    ))}
                  </div>
                </div>
              </div>
            </a>

            {/* Side post list */}
            <div style={{ display: "flex", flexDirection: "column", gap: "1px" }}>
              {SIDE_POSTS.map((post, i) => (
                <a
                  key={post.id}
                  href="#"
                  style={{
                    display: "block",
                    padding: "1.5rem",
                    borderRadius: "8px",
                    background: "transparent",
                    border: "1px solid transparent",
                    textDecoration: "none",
                    transition: "background 0.2s, border-color 0.2s, transform 0.2s",
                    marginBottom: "4px",
                  }}
                  onMouseEnter={(e) => {
                    const el = e.currentTarget as HTMLElement;
                    el.style.background = "#131008";
                    el.style.borderColor = "rgba(207,124,26,0.12)";
                    el.style.transform = "translateX(4px)";
                  }}
                  onMouseLeave={(e) => {
                    const el = e.currentTarget as HTMLElement;
                    el.style.background = "transparent";
                    el.style.borderColor = "transparent";
                    el.style.transform = "translateX(0)";
                  }}
                >
                  {/* Index + flair row */}
                  <div style={{ display: "flex", alignItems: "center", gap: "10px", marginBottom: "8px" }}>
                    <span
                      style={{
                        fontFamily: "'JetBrains Mono', monospace",
                        fontSize: "11px",
                        color: i === 0 ? amber : "#2d2820",
                        minWidth: "20px",
                      }}
                    >
                      {String(i + 1).padStart(2, "0")}
                    </span>
                    <span
                      style={{
                        fontSize: "10px",
                        padding: "2px 8px",
                        borderRadius: "3px",
                        background: `${post.flairColor}18`,
                        border: `1px solid ${post.flairColor}30`,
                        color: post.flairColor,
                        fontFamily: "'JetBrains Mono', monospace",
                        letterSpacing: "0.05em",
                      }}
                    >
                      {post.flair}
                    </span>
                    <span style={{ fontSize: "11px", color: "#3d3428" }}>{post.game}</span>
                  </div>

                  <h4
                    style={{
                      fontFamily: "'Cinzel', serif",
                      fontSize: "13px",
                      fontWeight: 500,
                      color: "#c8b898",
                      lineHeight: 1.5,
                      marginBottom: "10px",
                    }}
                  >
                    {post.title}
                  </h4>

                  <div style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                    <span style={{ fontSize: "11px", color: "#4a3f2e" }}>{post.author}</span>
                    <span style={{ display: "flex", alignItems: "center", gap: "4px", fontSize: "11px", color: "#3d3428", fontFamily: "'JetBrains Mono', monospace" }}>
                      <Clock size={11} /> {post.time}
                    </span>
                    <span style={{ display: "flex", alignItems: "center", gap: "4px", fontSize: "11px", color: "#3d3428", fontFamily: "'JetBrains Mono', monospace" }}>
                      <MessageSquare size={11} /> {post.comments}
                    </span>
                    <span style={{ display: "flex", alignItems: "center", gap: "4px", fontSize: "11px", color: "#3d3428", fontFamily: "'JetBrains Mono', monospace" }}>
                      <Heart size={11} /> {post.likes}
                    </span>
                  </div>
                </a>
              ))}

              <a
                href="#"
                style={{
                  display: "inline-flex",
                  alignItems: "center",
                  gap: "8px",
                  marginTop: "1rem",
                  padding: "10px 16px",
                  fontFamily: "'Cinzel', serif",
                  fontSize: "12px",
                  letterSpacing: "0.08em",
                  color: amber,
                  textDecoration: "none",
                  border: "1px solid rgba(207,124,26,0.22)",
                  borderRadius: "6px",
                  width: "fit-content",
                  transition: "background 0.2s",
                }}
                onMouseEnter={(e) => ((e.currentTarget as HTMLElement).style.background = amberGlow)}
                onMouseLeave={(e) => ((e.currentTarget as HTMLElement).style.background = "transparent")}
              >
                Read all threads <ArrowRight size={14} />
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* ── TESTIMONIALS ──────────────────────────────── */}
      <section
        style={{
          padding: "7rem 0",
          borderTop: "1px solid rgba(207,124,26,0.08)",
        }}
      >
        <div
          style={{ maxWidth: "1280px", margin: "0 auto", padding: "0 2.5rem" }}
        >
          <div
            style={{
              textAlign: "center",
              marginBottom: "4rem",
            }}
          >
            <div
              style={{
                fontFamily: "'JetBrains Mono', monospace",
                fontSize: "10px",
                letterSpacing: "0.25em",
                textTransform: "uppercase",
                color: amber,
                marginBottom: "0.75rem",
              }}
            >
              ── Voices from the Bonfire
            </div>
            <h2
              style={{
                fontFamily: "'Cinzel', serif",
                fontSize: "clamp(1.6rem, 3.5vw, 2.5rem)",
                fontWeight: 700,
                color: "#f0e8d4",
              }}
            >
              What the Community Says
            </h2>
          </div>

          <div
            style={{
              display: "grid",
              gridTemplateColumns: "repeat(3,1fr)",
              gap: "1.5rem",
            }}
          >
            {TESTIMONIALS.map((t) => (
              <div
                key={t.author}
                style={{
                  padding: "2rem",
                  borderRadius: "10px",
                  background: "#131008",
                  border: "1px solid rgba(207,124,26,0.1)",
                }}
              >
                {/* Quote marks */}
                <div
                  style={{
                    fontFamily: "'Cinzel', serif",
                    fontSize: "3rem",
                    lineHeight: 1,
                    color: amber,
                    opacity: 0.3,
                    marginBottom: "0.5rem",
                  }}
                >
                  "
                </div>
                <p
                  style={{
                    color: "#c8b898",
                    fontSize: "15px",
                    lineHeight: 1.8,
                    marginBottom: "1.5rem",
                    fontStyle: "italic",
                  }}
                >
                  {t.quote}
                </p>
                <div style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                  <div
                    style={{
                      width: 36,
                      height: 36,
                      borderRadius: "50%",
                      background: `linear-gradient(135deg, #cf7c1a, #6a3808)`,
                      display: "flex",
                      alignItems: "center",
                      justifyContent: "center",
                      fontFamily: "'Cinzel', serif",
                      fontSize: "13px",
                      fontWeight: 600,
                      color: "#faf0dc",
                    }}
                  >
                    {t.avatar}
                  </div>
                  <div>
                    <p style={{ fontSize: "13px", color: "#ede5d0", fontWeight: 500 }}>
                      {t.author}
                    </p>
                    <p style={{ fontSize: "11px", color: "#4a3f2e", fontFamily: "'JetBrains Mono', monospace" }}>
                      {t.rank}
                    </p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── JOIN BANNER ───────────────────────────────── */}
      <section style={{ padding: "0 2.5rem 7rem" }}>
        <div
          style={{
            maxWidth: "1280px",
            margin: "0 auto",
            borderRadius: "16px",
            overflow: "hidden",
            position: "relative",
          }}
        >
          <img
            src="https://images.unsplash.com/photo-1595319260223-c068746347cc?w=1400&h=500&fit=crop&auto=format"
            alt="Misty forest atmospheric banner"
            style={{
              position: "absolute",
              inset: 0,
              width: "100%",
              height: "100%",
              objectFit: "cover",
              filter: "brightness(0.25) saturate(0.5)",
            }}
          />
          <div
            style={{
              position: "absolute",
              inset: 0,
              background:
                "radial-gradient(ellipse 80% 80% at 50% 50%, rgba(207,124,26,0.12) 0%, rgba(9,8,5,0.6) 100%)",
            }}
          />
          <div
            style={{
              position: "relative",
              padding: "5rem 4rem",
              textAlign: "center",
            }}
          >
            {/* Flame icon */}
            <div style={{ marginBottom: "1.5rem" }}>
              <Flame size={36} color={amber} style={{ margin: "0 auto", opacity: 0.85, filter: `drop-shadow(0 0 16px ${amber})` }} />
            </div>
            <h2
              style={{
                fontFamily: "'Cinzel', serif",
                fontSize: "clamp(1.6rem, 4vw, 2.8rem)",
                fontWeight: 700,
                color: "#f0e8d4",
                marginBottom: "1rem",
                lineHeight: 1.2,
              }}
            >
              The Bonfire Awaits
            </h2>
            <p
              style={{
                color: "#8a7a62",
                fontSize: "16px",
                lineHeight: 1.7,
                maxWidth: "480px",
                margin: "0 auto 2.5rem",
              }}
            >
              Join 12,000+ dark RPG enthusiasts. Free forever. No hollow
              deal required.
            </p>
            <div style={{ display: "flex", justifyContent: "center", gap: "12px", flexWrap: "wrap" }}>
              <a
                href="#"
                style={{
                  padding: "14px 36px",
                  fontFamily: "'Cinzel', serif",
                  fontSize: "13px",
                  fontWeight: 600,
                  letterSpacing: "0.1em",
                  background: "linear-gradient(135deg, #cf7c1a 0%, #9a5510 100%)",
                  color: "#fff8ec",
                  textDecoration: "none",
                  borderRadius: "6px",
                  boxShadow: "0 8px 40px rgba(207,124,26,0.35)",
                  transition: "transform 0.2s",
                }}
                onMouseEnter={(e) => ((e.currentTarget as HTMLElement).style.transform = "translateY(-2px)")}
                onMouseLeave={(e) => ((e.currentTarget as HTMLElement).style.transform = "translateY(0)")}
              >
                Create Free Account
              </a>
              <a
                href="#"
                style={{
                  padding: "14px 28px",
                  fontFamily: "'Cinzel', serif",
                  fontSize: "13px",
                  letterSpacing: "0.08em",
                  background: "rgba(255,255,255,0.06)",
                  color: "#c8b898",
                  textDecoration: "none",
                  borderRadius: "6px",
                  border: "1px solid rgba(255,255,255,0.1)",
                }}
              >
                Browse as Guest
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* ── FOOTER ────────────────────────────────────── */}
      <footer
        style={{
          borderTop: "1px solid rgba(207,124,26,0.1)",
          padding: "4rem 2.5rem 3rem",
        }}
      >
        <div
          style={{
            maxWidth: "1280px",
            margin: "0 auto",
            display: "grid",
            gridTemplateColumns: "2fr 1fr 1fr 1fr",
            gap: "3rem",
          }}
        >
          {/* Brand col */}
          <div>
            <div
              style={{
                fontFamily: "'Cinzel', serif",
                fontSize: "20px",
                fontWeight: 700,
                letterSpacing: "0.16em",
                color: amber,
                textShadow: "0 0 20px rgba(207,124,26,0.35)",
                marginBottom: "1rem",
              }}
            >
              RESTPOINT
            </div>
            <p style={{ color: "#4a3f2e", fontSize: "13px", lineHeight: 1.8, maxWidth: "240px" }}>
              The dark RPG sanctuary. Where the undead find community, and the
              flame endures.
            </p>
            <div style={{ display: "flex", gap: "10px", marginTop: "1.5rem" }}>
              {["Discord", "Twitter", "YouTube"].map((s) => (
                <a
                  key={s}
                  href="#"
                  style={{
                    padding: "6px 12px",
                    borderRadius: "5px",
                    background: "rgba(255,255,255,0.04)",
                    border: "1px solid rgba(207,124,26,0.1)",
                    color: "#6a5d49",
                    fontSize: "11px",
                    fontFamily: "'JetBrains Mono', monospace",
                    textDecoration: "none",
                    transition: "color 0.2s, border-color 0.2s",
                  }}
                  onMouseEnter={(e) => {
                    (e.currentTarget as HTMLElement).style.color = amber;
                    (e.currentTarget as HTMLElement).style.borderColor = "rgba(207,124,26,0.3)";
                  }}
                  onMouseLeave={(e) => {
                    (e.currentTarget as HTMLElement).style.color = "#6a5d49";
                    (e.currentTarget as HTMLElement).style.borderColor = "rgba(207,124,26,0.1)";
                  }}
                >
                  {s}
                </a>
              ))}
            </div>
          </div>

          {/* Link cols */}
          {[
            { heading: "Community", links: ["Forums", "Guilds", "Events", "Leaderboard", "Discord"] },
            { heading: "Content", links: ["Game Reviews", "Build Guides", "Lore Archive", "News", "Podcasts"] },
            { heading: "Account", links: ["Sign Up", "Log In", "Profile", "Settings", "Premium"] },
          ].map((col) => (
            <div key={col.heading}>
              <h4
                style={{
                  fontFamily: "'Cinzel', serif",
                  fontSize: "11px",
                  fontWeight: 600,
                  letterSpacing: "0.15em",
                  textTransform: "uppercase",
                  color: "#6a5d49",
                  marginBottom: "1.25rem",
                }}
              >
                {col.heading}
              </h4>
              <ul style={{ listStyle: "none", padding: 0, margin: 0, display: "flex", flexDirection: "column", gap: "10px" }}>
                {col.links.map((l) => (
                  <li key={l}>
                    <a
                      href="#"
                      style={{
                        color: "#4a3f2e",
                        textDecoration: "none",
                        fontSize: "13px",
                        transition: "color 0.2s",
                      }}
                      onMouseEnter={(e) => ((e.currentTarget as HTMLElement).style.color = "#c8b898")}
                      onMouseLeave={(e) => ((e.currentTarget as HTMLElement).style.color = "#4a3f2e")}
                    >
                      {l}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>

        {/* Bottom bar */}
        <div
          style={{
            maxWidth: "1280px",
            margin: "3rem auto 0",
            paddingTop: "1.5rem",
            borderTop: "1px solid rgba(207,124,26,0.07)",
            display: "flex",
            alignItems: "center",
            justifyContent: "space-between",
            flexWrap: "wrap",
            gap: "1rem",
          }}
        >
          <p style={{ fontSize: "12px", color: "#2d2820", fontFamily: "'JetBrains Mono', monospace" }}>
            © 2026 RestPoint · All embers reserved · Age of Flames IV
          </p>
          <div style={{ display: "flex", gap: "24px" }}>
            {["Privacy", "Terms", "Cookies"].map((l) => (
              <a
                key={l}
                href="#"
                style={{ color: "#2d2820", fontSize: "12px", textDecoration: "none", fontFamily: "'JetBrains Mono', monospace" }}
              >
                {l}
              </a>
            ))}
          </div>
        </div>
      </footer>

      {/* Global scroll styles */}
      <style>{`
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { scrollbar-width: thin; scrollbar-color: rgba(207,124,26,0.18) transparent; }
        @media (max-width: 900px) {
          .hidden-mobile { display: none !important; }
          .show-mobile { display: flex !important; }
        }
        @media (min-width: 901px) {
          .show-mobile { display: none !important; }
        }
      `}</style>
    </div>
  );
}
