# HORARIUM-NAME.md

**Project:** Rule of life tracker (formerly *Exodus 40 Lite*)
**Decision date:** 2026-08-01
**Status:** Decided. Domain registered. Rename executed 2026-08-01.
**Canonical domain:** `horarium.us` (Porkbun, $4.43 first year, $7.00/yr renewal)
**Store listing string:** `Horarium — Rule of Life Tracker`
**Tagline:** *A faithful rhythm for every season.*

---

## 1. Purpose of this document

This file exists so the naming question is not relitigated. It records what the
old name was, why it failed, what was considered instead, what evidence cleared
Horarium, and what was explicitly rejected and on what grounds. It follows the
same structure as `NIGHTLOCH-NAME.md`, `KEEPLORE-NAME.md`, and
`FARELOCH-NAME.md`.

If a future version of me is tempted to rename this app again, read section 5
first. Most of the obvious alternatives are already dead, and the evidence is
below.

---

## 2. Why "Exodus 40 Lite" failed

Ordered by long-term cost rather than by obviousness. The first item is the one
that surfaced first; the later items are the ones that actually mattered.

### 2.1 Trademark and affiliation exposure (highest severity)

Exodus 90 is operated by XDS, Inc. / Exodus, Inc. of Fort Wayne, Indiana, and
markets a paid Lent product called **Exodus 40**. Naming a free, publicly
distributed Catholic ascetical-discipline tracker "Exodus 40 Lite" does three
things simultaneously, each independently bad:

- It reproduces their exact product name.
- The "Lite" suffix affirmatively implies a free tier of *their* product — the
  conventional meaning of "Lite" in app-store naming is a reduced-feature
  version of a paid app by the same publisher.
- It positions the app as a substitute for a commercial offering in the same
  category, for the same audience, with the same core mechanic.

This is not a nominative-fair-use situation. Nominative use lets you *refer* to
a mark to identify it; it does not let you *adopt* it as your product name. The
disclaimer in section 7 handles the legitimate acknowledgment of influence. The
name could not.

### 2.2 Namespace pollution outside the Catholic niche

"Exodus" is heavily occupied by larger, better-funded entities in software:

- **Exodus** — a widely used cryptocurrency wallet with apps on both stores.
- **Exodus Privacy** — a well-known Android application-tracker analysis project.

A parish app named Exodus would never rank for its own name, on the web or in
either store. Zero-install discovery would be structurally impossible.

### 2.3 The name locked the product to a liturgical shape it had already outgrown

This is the deepest problem and the reason the rename happened when it did.
`manifest.json` already read:

> "Rule of life tracker for the Good Wine Group"

with no mention of Lent. The code outgrew the season before the name did. The
numeral "40" hard-codes a single penitential window into the brand at exactly
the moment `Season` was being refactored into a first-class configurable object
with a start date, end date, enabled disciplines, and weekly targets.

A rule of life is inherently year-round. The term descends from the Latin
*regula* — a rhythm of practices orienting a person toward Christ across
seasons, not a fixed-length program. Monastics revise their rule quarterly or
annually, not liturgically. Under the new architecture, Lent 2026
(Ash Wednesday 18 Feb → Holy Saturday 4 Apr, 46 days) becomes **one preset**
alongside Advent, St. Michael's Lent, Ember Days, and an open-ended Ordinary
Time default. A name containing "40" would have contradicted the data model on
day one.

### 2.4 Numerals are weak marks

Bare numerals are difficult to register and confer little distinctiveness. "40"
also carried the additional defect of being factually wrong for the season it
named — Lent 2026 spans 46 days, not 40.

---

## 3. Why "Horarium" won

### 3.1 The name and the data model agree

A *horarium* is the fixed daily order of a religious house — the schedule by
which a monastery or seminary orders prayer, work, meals, silence, and
community life. Latin *hora*, "hour"; the word means "of the hours."

The decisive property: **a horarium changes its contents by season without ever
ceasing to be the horarium.** Ampleforth publishes a Christmas horarium.
Communities keep a Lenten horarium and an ordinary horarium. The structure
persists; the entries vary.

That is, precisely and without metaphor, the `Season` refactor. The name
describes the schema.

### 3.2 It is authentically Catholic without naming a devotion or an organization

Horarium is standard vocabulary in Benedictine, Carmelite, and seminary usage.
It signals Catholic formation without invoking a sacrament, a specific prayer,
a religious order, or another organization's program. It is not Exodus 90's
vocabulary — they use "fraternity," "anchor," "asceticism," "exercises."

It also does not restrict the app to a single office the way *Matins*,
*Compline*, or *Lectio* would, and it does not name a physical space the way
*Cloister* or *Cell* would.

### 3.3 It fits the portfolio

Chart35, Caeven, Quadrille, Peakwise, Fareloch, Inkvoke, Keeplore, Nightloch,
Verelle. Short Latinate or coined head, slightly opaque, paired with a
descriptive tail that carries store SEO. Horarium sits comfortably beside
Quadrille.

### 3.4 It survives the honest weaknesses

- **Spell test: moderate.** "ho-RAIR-ee-um." Heard once, a listener might
  produce *horareum* or *horarrium*. This is acceptable **because of the
  distribution model** — a QR code and a link at a parish meeting, not radio or
  word-of-mouth store search. It would not be acceptable for a consumer app.
- **Guess test: weak naked, strong with the tail.** First three guesses from a
  stranger: a calendar app, a timetable app, a Latin dictionary. All three are
  in the neighborhood of "scheduled recurring things," which is better than most
  Latinate coinages manage. `Horarium — Rule of Life Tracker` closes the gap.

Mitigation: the About screen and first-run flow define the word and turn the
unfamiliarity into brand meaning.

> A *horarium* is the daily order of a monastic house. This one is yours.

---

## 4. Clearance evidence

Run 2026-08-01. **This is a knockout search, not a legal opinion.** No attorney
reviewed it. It is sufficient for a free, non-commercial parish tool and is not
sufficient if the app is ever monetized or a federal registration is filed.

### 4.1 USPTO — `tmsearch.uspto.gov`

Wordmark search for `horarium`, Live **and** Dead status filters both enabled,
no class restriction.

| Result | Count |
|---|---|
| Live records | **0** |
| Dead records | **0** |

No pending applications, no abandoned filings, no cancelled registrations.
Nothing in Class 9 (downloadable software), Class 42 (SaaS / non-downloadable),
or Class 45 (religious services). No filing by Softix SRL or any other
timetable vendor.

Independently confirmed against the Justia trademark index: no matching
records.

**The word is entirely unclaimed on the US federal register.**

### 4.2 WHOIS / RDAP on the two unavailable TLDs

The operative risk was that an adjacent-category software vendor — specifically
Softix SRL, who operate Horarium.ai school-timetabling software — held both
primary namespaces ahead of a Class 42 filing. That risk did not materialize.

| Domain | Registrant | Registered | Expires | Assessment |
|---|---|---|---|---|
| `horarium.com` | **HugeDomains.com** (Domain Admin, "This Domain is For Sale"), 2635 Walnut St, Denver CO | 2017-07-19 | 2027-07-19 | Speculative reseller inventory. Parked on NameBright DNS. No product, no commercial use, listed for sale. The least threatening possible holder. |
| `horarium.app` | Redacted; registrar **Squarespace Domains** (ex-Google Domains) | 2026-01-05 | 2027-01-05 | Sitting on default `ns-cloud-c*.googledomains.com` nameservers. Unconfigured — no site, no mail, no deployed product. |

Neither traces to Softix SRL, Horarium.ai, or any Untis-related entity.

### 4.3 App stores

No app titled "Horarium" exists in the religious, spiritual-formation,
habit-tracking, or productivity categories on either store.

Known adjacent uses, all confirmed **common-law only** with no federal
registration behind them:

- **Horarium.ai** (Softix SRL) — school timetable generation SaaS, web/iOS/Android.
- **"Horarium – Timetable for Untis"** — Apple App Store, a companion app for
  the Untis school scheduling system, primarily German-market.
- **Horarium** (.NET) — an open-source background-job scheduling library,
  ~45k NuGet downloads, originally from TinkoffBank. Developer-facing search
  noise only.

These are a findability annoyance, not a legal obstacle. They occupy education
scheduling and developer tooling; they do not compete for "rule of life tracker"
and they do not reach a Catholic parish audience.

### 4.4 Not verified

- **WIPO Global Brand Database** — the query was blocked by a bot-verification
  challenge and could not be read. Relevant only for international
  distribution; US clearance is the operative question for a Philadelphia
  parish app.
- No professional clearance search was commissioned.

---

## 5. Rejected alternatives, with blocking evidence

Do not reopen any of these without new evidence. Each was killed by a specific
finding, not by taste.

### 5.1 Rejected in the final round

| Name | Blocking evidence |
|---|---|
| **Rhythora** | **Rhythora: Offline music player** is live on Google Play, updated March 2026 — a direct title collision in the exact store this app publishes to. Also a Spotify artist "Rhythora" (562 followers), releases on Audiomack and Amazon Music, a "Rhythora Music Studio" YouTube channel, `@tm.rhythora` on Instagram, and **RHYTHORA CREATIONS LTD** registered at UK Companies House. The "rhyth-" stem reads as *rhythm*, which is why a music player took it; every user guess resolves to audio. `rhythora.app` was available at $8.75/$14.93 and was declined on these grounds. |
| **Hydria** | Best narrative of any candidate — the six stone water jars at Cana (Jn 2) map 1:1 onto the six discipline categories, and the group is the Good Wine Group ("you have kept the good wine until now"). Dead on contact with the stores: **Hydria: Water Tracker** is live on the Apple App Store, updated July 2026, a hydration/calorie *tracker* — same functional category, near-identical name. `hydria.app` is separately taken by a youth-built ocean-plastic app on Google Play. Both the store slot and the `.app` are gone. |
| **Perdura** | Not rejected. Held in reserve as the fallback coinage (from *perdurare*, "to endure through") if Horarium had failed clearance. It did not. Perdura remains unverified and unpurchased. |

### 5.2 Rejected earlier, with evidence

| Name | Blocking evidence |
|---|---|
| Exodus / Exodus 40 / Exodus Lite | See section 2. |
| Lenten Rule | Season-constrained; contradicts the year-round pivot. `lentenrule.com` and `.app` were both available and were declined for this reason alone. |
| Elim | `elim.com` and `elim.app` both unavailable. |
| Habitus | Taken three times: Google Play habit tracker, Habitus: Weekly Mindset, Habitus Health. |
| Manna | National Eucharistic Congress "Manna" plus "Manna† Catholic App." |
| Cenacle | "Cenacle (Upper Room)" live on the App Store. |
| Cairn | Cairn hiking tracker asserts a mark; separate CAIRN filing by The Game Bakers. |
| Trellis | Trellis farm platform, Trellis Enterprise, Trellis/Vagrant, Trellis capital. |
| Anchor | Exodus 90's own term for an accountability partner; also generic in both stores. |
| Crux | Ascension's "Crux: A Lenten Journey of Surrender." |
| KeepLent | Papal-endorsed Catholic youth initiative. |
| Regula | Regula Forensics Inc. — Regula Document Reader SDK, active commercial mark. |
| Ordo | Crowded in the exact niche: Ordo 2026, Ordo–Trinity Missions, ORDO liturgical calendar. |
| Cloister | Cloisters Ignatian Prayer (Cloisters Digital LLC, Omaha) live on both stores — a subscription Catholic formation app. Also Cloister Bronnbach, Cloister Curator, and Cloister (defense compliance AI). |
| Statio | "Statio — Bible & Journal" markets itself as a private place for prayer, journaling, and Scripture. Same product, same audience, same name. Also Statio analytics and Statio warehouse management. |
| Sojourn | Saturated in the church-app category: Sojourn New Albany, Sojourn Community Church of Beaumont, plus Your Sojourn and Sojourn AI in travel. |
| Wayfare | Phonetically identical to Wayfair, which has 10M+ install apps on both stores. Unwinnable search fight. |
| Pillar | "Pillar — Become Unstoppable" is a habit tracker with routines and rankings on both stores. Also Pillars: Prayer Times & Qibla. |
| Marah | Marah World, Marah (livestock management), Marah Business, مراح. Also "bitter waters" is the wrong emotional register, and it is Exodus vocabulary. |
| Ascesis | "Project: ASCESIS" on Steam and itch.io; "Ascetic" daily-practice app on Google Play. Spelling drift between *ascesis* / *askesis* / *acesis* is fatal for organic search. |
| Desert Rule | Two-word descriptive phrase, weak as a mark. "Desert" reimports forty-days wilderness imagery — the exact season-lock being escaped. |
| Rulekeeper | Comprehensible but descriptive. "RuleKeeper" is already the name of a published GDPR-compliance system. Off-brand against Quadrille/Caeven. |
| Ruleward | Ruleward.com is a live regulatory-change-monitoring SaaS. |
| Viaforma | Historical Class 9 trademark-publication records in Brazil; existing international commercial use. |
| Lectio | Lectio 365 (24-7 Prayer) is a large incumbent on both stores. Also narrows the app to reading. |
| Compline / Matins / Vespers | Time-of-day-locked — a subtler version of the same failure as season-locking. Dominican Compline and OSH Compline occupy the space. |
| Custos | Custos Home (leak detection, both stores), Custos FO, Custos (security, Colombia). |
| Vinea | Vinea AI sommelier, Vinea vineyard management, Vinea Inc. healthcare CME, ClimaVinea. |
| Cana | Cana Covenant — a live Catholic couples' formation app with daily prompts and a streak mechanic. |
| Covenant | Common religious term, weak distinctiveness, and Cana Covenant occupies adjacent ground. |
| Oblate | Conceptually precise — a layperson living a monastic rule in the world. But "oblate spheroid" destroys the guess test, and the OMI order's institutional use raises a Class 45 question. |

---

## 6. Domain decision

`horarium.com` and `horarium.app` were both unavailable. Porkbun offered:

| Domain | Year 1 | Renewal | 10-yr | Verdict |
|---|---|---|---|---|
| **horarium.us** | **$4.43** | **$7.00** | **~$68** | **Registered.** Cheapest long-term, genuine US nexus (West Philadelphia parish), reads institutional rather than cut-rate. |
| horarium.dev | $8.75 | $12.87 | ~$124 | Declined. Signals "developer tool" — wrong audience, and it reinforces the existing .NET-library search noise. Portfolio precedent is `.dev` for CLI tools (Inkvoke) and `.app` for apps. |
| horarium.xyz | $2.04 | $12.98 | ~$119 | Declined. Teaser pricing, weak trust, poor deliverability reputation. |
| horarium.quest | $1.54 | $12.98 | ~$118 | Declined. Thematically amusing (pilgrimage) but gimmicky, and "quest" reintroduces the finite-program connotation being escaped. |
| horarium.homes | $1.54 | $12.98 | — | Declined. Real-estate TLD. |
| horarium.vip | $4.12 | $15.96 | — | Declined. Exclusivity/nightlife register, actively wrong for a tracker whose categories include Fasting, Almsgiving, and Asceticism. |
| horarium.us.com | $15.76 | $15.76 | ~$158 | Declined. A third-level registration beneath a privately operated `us.com` zone, not a registry TLD. Worst of both worlds and confusing to non-technical users. |

Also considered and declined: `horarium.stephens.page`. Free, already-owned
zone, and Digital Asset Links work fine on a subdomain — but the portfolio
pattern is to move *off* `stephens.page` when a project becomes real, as
`macros.stephens.page` did when it became Fareloch.

**Note:** `horarium.com` is HugeDomains inventory, meaning it has a listed
asking price rather than being genuinely unobtainable. HugeDomains typically
prices four figures on Latin one-word domains. Not worth it for a parish tool,
but it is purchasable rather than locked away if this ever grows.

### `.us`-specific consequences

Two real differences from the `.app` pattern used for Fareloch, Keeplore,
Nightloch, and Verelle:

1. **Nexus requirement.** `.us` registrants must be US citizens, residents, or
   entities, and the Nexus category is a mandatory field at checkout.
   Philadelphia residency satisfies it trivially.
2. **No registry-level HSTS.** `.app` and `.dev` are on the HSTS preload list at
   the registry level; `.us` is not. HTTPS must be enforced at Cloudflare, the
   `Strict-Transport-Security` header must be set explicitly, and the domain
   should be submitted to the preload list once stable. This matters for a PWA
   and for TWA trust.

---

## 7. Non-affiliation language

To be added to `README.md` and the in-app About screen. This is nominative
reference: it names Exodus 90 only to identify a source of influence, uses no
logo, typeface, or trade dress, and expressly disclaims sponsorship.

### README version

> ### Non-affiliation
>
> Horarium is an independent, open-source project built by and for a parish
> men's group. It is not affiliated with, endorsed by, sponsored by, or
> connected to XDS, Inc., Exodus, Inc., or the Exodus 90 or Exodus 40 programs.
> "Exodus 90" and "Exodus 40" are referenced here only descriptively, to
> acknowledge an influence on this project's approach to fraternity-based
> ascetical practice. All trademarks are the property of their respective
> owners.

### About-screen version

> Horarium is an independent project. We're not affiliated with Exodus 90 or
> Exodus 40, and we're grateful to them anyway — their work shaped how we think
> about fraternity and ascetical practice. This app is our own, built for our
> own group's rule of life.

### Three standing rules

1. **Never** put "Exodus" in the app title, subtitle, store keywords field,
   package ID, domain, or store metadata. Keyword fields are where nominative
   fair use arguments go to die.
2. **Do not reuse their program-specific vocabulary as feature names.** Most
   importantly, do not use **"Anchor"** for an accountability partner. Use
   *Brother*, *Companion*, or *Witness*.
3. **If this ever charges money**, have a lawyer read section 7. Commercial
   context narrows the nominative-use safe harbor, and the knockout search in
   section 4 is not a clearance opinion.

---

## 8. Open items

- [ ] WIPO Global Brand Database check (blocked by bot challenge on 2026-08-01).
      Only required if international distribution is contemplated.
- [ ] Re-run the USPTO search before any federal filing. A clearance search is
      only as good as its search date.
- [x] Execute the rename (2026-08-01). Product surface, package ID
      (`us.horarium.app`), GitHub repo, live deploy, and `horarium.us` host.
      Digital Asset Links re-verified against the new package ID. Pre-existing
      installs on `page.stephens.exodus40lite` are a separate listing and are
      not migrated in place.

---

## 9. Decision record

| Field | Value |
|---|---|
| Old name | Exodus 40 Lite |
| New name | Horarium |
| Store listing | `Horarium — Rule of Life Tracker` |
| Short description | Track prayer, fasting, almsgiving, and discipline — every day, all year. |
| Tagline | A faithful rhythm for every season. |
| Alternate tagline | Order your days toward Christ. |
| Domain | `horarium.us`, registered at Porkbun 2026-08-01 |
| Fallback if reopened | Perdura (unverified) |
| Decided by | Jacob Stephens |
| Date | 2026-08-01 |
