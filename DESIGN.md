# Scribble Arena Design Direction

## References

- Game UI Database: use for lobby, menu, scoreboard, and player-list inspiration.
- Interface In Game: use for real game screen structure and HUD patterns.
- Free Game UI: use only for CC0 assets if custom buttons, panels, or icons are needed later.
- Kenney UI packs: use only for CC0 game UI assets if the interface needs more game texture later.

## Style

Scribble Arena should feel like a simple Skribbl-style casual multiplayer web game, not a SaaS dashboard and not a generic AI landing page.

Use a teal doodle-pattern background, centered menu cards, bright action buttons, readable room codes, and a white drawing-board layout.

## Palette

- App background: teal/blue gradient over doodle pattern
- Surface: white
- Primary action: blue `#2563eb`
- Secondary action: emerald `#10b981`
- Success: emerald `#6ee7b7`
- Danger/highlight: rose `#fb7185`
- Canvas: near-white `#f8fafc`
- Main text: slate
- Muted text: gray/slate

## UI Rules

- Keep cards at `8px` radius.
- Prefer centered menu cards for entry screens.
- Use strong labels for room code, player count, rounds, timer, and status.
- Keep forms short and direct, similar to classic browser party games.
- Avoid visible roadmap or phase language inside the app UI.
- Use the room code as the main visual object on lobby screens.
- Keep dashboard secondary; the game flow is the product.

## Screens

Home:
- Centered logo.
- Single white menu card.
- Name input.
- Create room button.
- Divider.
- Room code input and join button.

Play:
- Lightweight room menu.
- Create or join with existing nickname.
- Compact status summary.

Lobby:
- Top white room info bar.
- Left player ranking list.
- Large white drawing-board preview in the center.
- Right chat panel.
- Bottom drawing toolbar preview.

Dashboard:
- Account-focused but quiet.
- Link users back to play quickly.
- Reserve history and leaderboard sections for later.
