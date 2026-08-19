<div id="agente-chat" class="agente-chat">
    <section
        id="agente-chat-painel"
        class="agente-chat__painel"
        aria-label="Ajuda rápida com inteligência artificial"
        aria-hidden="true"
        hidden
    >
        <header class="agente-chat__cabecalho">
            <div class="agente-chat__titulo">
                <span class="agente-chat__titulo-icone" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 2l1.3 4.2L17.5 7.5l-4.2 1.3L12 13l-1.3-4.2L6.5 7.5l4.2-1.3L12 2Z"
                        />
                        <path
                            d="M19 13l.8 2.2L22 16l-2.2.8L19 19l-.8-2.2L16 16l2.2-.8L19 13Z"
                        />
                    </svg>
                </span>

                <div>
                    <h2>Ajuda rápida com IA</h2>
                    <p>Tire dúvidas em linguagem simples.</p>
                </div>
            </div>

            <div class="agente-chat__controles">
                <button
                    id="agente-chat-minimizar"
                    class="agente-chat__controle"
                    type="button"
                    aria-label="Minimizar chat"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14" />
                    </svg>
                </button>

                <button
                    id="agente-chat-fechar"
                    class="agente-chat__controle"
                    type="button"
                    aria-label="Fechar chat"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M6 6l12 12M18 6 6 18" />
                    </svg>
                </button>
            </div>
        </header>

        <div class="agente-chat__conteudo">
            <div id="agente-chat-inicio">
                <aside class="agente-chat__aviso">
                    <span class="agente-chat__aviso-icone" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 10v6M12 7.2v.2" />
                        </svg>
                    </span>

                    <p>
                        Sou um assistente de apoio.
                        <strong>Não substituo fontes oficiais.</strong>
                    </p>
                </aside>

                <section class="agente-chat__sugestoes">
                    <h3>Sugestões rápidas</h3>

                    <button
                        class="agente-chat__sugestao"
                        type="button"
                        data-question="O que faz um senador?"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 10h18M5 10v8M9 10v8M15 10v8M19 10v8M3 19h18M4 7l8-4 8 4" />
                        </svg>

                        <span>O que faz um senador?</span>
                    </button>

                    <button
                        class="agente-chat__sugestao"
                        type="button"
                        data-question="Como funciona uma emenda parlamentar?"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6 3h8l4 4v14H6z" />
                            <path d="M14 3v5h5M9 12h6M9 16h6" />
                        </svg>

                        <span>Como funciona uma emenda?</span>
                    </button>

                    <button
                        class="agente-chat__sugestao"
                        type="button"
                        data-question="Onde posso denunciar um problema relacionado ao serviço público?"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 13v-3l12-5v13L4 13Z" />
                            <path d="M7 14v5h4v-4M16 9l4-2M16 14l4 2" />
                        </svg>

                        <span>Onde denunciar?</span>
                    </button>

                    <button
                        class="agente-chat__sugestao"
                        type="button"
                        data-question="O que significa valor empenhado em um orçamento público?"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M15 9.5c-.7-.8-1.7-1.2-3-1.2-1.7 0-3 .8-3 2s1 1.8 3 2.1 3 .9 3 2.1-1.3 2.1-3 2.1c-1.3 0-2.4-.4-3.2-1.3M12 6.5v11" />
                        </svg>

                        <span>O que é valor empenhado?</span>
                    </button>
                </section>

                <section class="agente-chat__voz">
                    <button
                        id="agente-chat-ouvir"
                        class="agente-chat__voz-botao"
                        type="button"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 10v4h4l5 4V6L8 10H4Z" />
                            <path d="M16 9a4 4 0 0 1 0 6M18.5 6.5a8 8 0 0 1 0 11" />
                        </svg>

                        <span>
                            <strong>Ler resposta em voz alta</strong>
                            <small>Pressione para ouvir</small>
                        </span>
                    </button>

                    <label class="agente-chat__switch">
                        <input
                            id="agente-chat-voz-automatica"
                            type="checkbox"
                            aria-label="Ler respostas automaticamente"
                        >

                        <span class="agente-chat__switch-visual"></span>
                    </label>
                </section>

                <div class="agente-chat__ilustracao" aria-hidden="true">
                    <svg viewBox="0 0 240 170">
                        <path
                            d="M112 28h72a15 15 0 0 1 15 15v62a15 15 0 0 1-15 15h-21l-20 17v-17h-31a15 15 0 0 1-15-15V43a15 15 0 0 1 15-15Z"
                        />

                        <path
                            d="M43 72h71a15 15 0 0 1 15 15v41a15 15 0 0 1-15 15H75l-22 16v-16H43a15 15 0 0 1-15-15V87a15 15 0 0 1 15-15Z"
                        />

                        <path d="M124 61h45M124 78h54M58 101h41" />
                    </svg>
                </div>
            </div>

            <div
                id="agente-chat-mensagens"
                class="agente-chat__mensagens"
                aria-live="polite"
                hidden
            ></div>
        </div>

        <form id="agente-chat-formulario" class="agente-chat__formulario">
            <label class="agente-chat__label" for="agente-chat-input">
                Digite sua pergunta
            </label>

            <div class="agente-chat__campo">
                <textarea
                    id="agente-chat-input"
                    name="mensagem"
                    rows="1"
                    maxlength="2000"
                    placeholder="Digite sua pergunta..."
                    required
                ></textarea>

                <button
                    id="agente-chat-enviar"
                    class="agente-chat__enviar"
                    type="submit"
                    aria-label="Enviar pergunta"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="m3 11 17-8-6.5 18-3.4-7.1L3 11Z" />
                        <path d="m10.1 13.9 4.5-4.5" />
                    </svg>
                </button>
            </div>

            <p class="agente-chat__atalho">
                <span><strong>Enter</strong> envia</span>
                <span aria-hidden="true">•</span>
                <span><strong>Shift + Enter</strong> quebra a linha</span>
            </p>
        </form>

        <footer class="agente-chat__rodape">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="5" y="10" width="14" height="10" rx="2" />
                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
            </svg>

            <span>Fontes oficiais sempre visíveis</span>

            <svg
                class="agente-chat__rodape-confirmacao"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="9" />
                <path d="m8 12 2.5 2.5L16 9" />
            </svg>
        </footer>
    </section>

    <button
        id="agente-chat-abrir"
        class="agente-chat__abrir"
        type="button"
        aria-label="Abrir ajuda rápida com inteligência artificial"
        aria-controls="agente-chat-painel"
        aria-expanded="false"
    >
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path
                d="M12 2l1.3 4.2L17.5 7.5l-4.2 1.3L12 13l-1.3-4.2L6.5 7.5l4.2-1.3L12 2Z"
            />
            <path
                d="M19 13l.8 2.2L22 16l-2.2.8L19 19l-.8-2.2L16 16l2.2-.8L19 13Z"
            />
        </svg>

        <span>Ajuda rápida</span>
    </button>
</div>

@once
    {{-- Bibliotecas para interpretar e proteger Markdown --}}
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify/dist/purify.min.js"></script>

    <style>
        .agente-chat {
            --chat-verde: #168347;
            --chat-verde-escuro: #0d6937;
            --chat-verde-claro: #eaf6ef;
            --chat-texto: #242424;
            --chat-texto-secundario: #626262;
            --chat-borda: #d7d7d7;
            --chat-fundo: #ffffff;
            --chat-fundo-secundario: #f6f7f6;

            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 9999;
            color: var(--chat-texto);
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            font-size: 16px;
        }

        .agente-chat *,
        .agente-chat *::before,
        .agente-chat *::after {
            box-sizing: border-box;
        }

        .agente-chat button,
        .agente-chat textarea {
            font: inherit;
        }

        .agente-chat button {
            -webkit-tap-highlight-color: transparent;
        }

        .agente-chat svg {
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .agente-chat__painel {
            display: flex;
            flex-direction: column;
            width: min(430px, calc(100vw - 32px));
            height: min(720px, calc(100dvh - 48px));
            overflow: hidden;
            background: var(--chat-fundo);
            border: 1px solid var(--chat-borda);
            border-radius: 24px;
            box-shadow:
                0 24px 70px rgba(0, 0, 0, 0.16),
                0 4px 14px rgba(0, 0, 0, 0.08);
            animation: agenteChatEntrada 180ms ease-out;
        }

        .agente-chat__painel[hidden] {
            display: none;
        }

        .agente-chat__cabecalho {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: space-between;
            min-height: 88px;
            padding: 18px 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .agente-chat__titulo {
            display: flex;
            align-items: center;
            min-width: 0;
            gap: 12px;
        }

        .agente-chat__titulo-icone {
            width: 28px;
            height: 28px;
            flex: 0 0 auto;
        }

        .agente-chat__titulo-icone svg {
            width: 100%;
            height: 100%;
        }

        .agente-chat__titulo h2 {
            margin: 0 0 4px;
            font-size: 20px;
            font-weight: 750;
            line-height: 1.2;
        }

        .agente-chat__titulo p {
            margin: 0;
            color: var(--chat-texto-secundario);
            font-size: 14px;
            line-height: 1.4;
        }

        .agente-chat__controles {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .agente-chat__controle {
            display: grid;
            width: 44px;
            height: 44px;
            padding: 10px;
            place-items: center;
            color: #444444;
            background: transparent;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
        }

        .agente-chat__controle:hover {
            background: #f0f0f0;
        }

        .agente-chat__controle:focus-visible {
            outline: 3px solid rgba(22, 131, 71, 0.25);
        }

        .agente-chat__controle svg {
            width: 22px;
            height: 22px;
        }

        .agente-chat__conteudo {
            flex: 1;
            min-height: 0;
            padding: 20px;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .agente-chat__aviso {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
            padding: 16px;
            color: #555555;
            background: var(--chat-fundo-secundario);
            border: 1px solid #e1e1e1;
            border-radius: 14px;
        }

        .agente-chat__aviso-icone {
            width: 24px;
            height: 24px;
            flex: 0 0 auto;
        }

        .agente-chat__aviso-icone svg {
            width: 100%;
            height: 100%;
        }

        .agente-chat__aviso p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .agente-chat__aviso strong {
            display: block;
            margin-top: 2px;
            font-weight: 600;
        }

        .agente-chat__sugestoes h3 {
            margin: 0 0 12px;
            font-size: 16px;
            font-weight: 700;
        }

        .agente-chat__sugestao {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 52px;
            gap: 12px;
            margin-bottom: 10px;
            padding: 12px 14px;
            color: #4d4d4d;
            text-align: left;
            background: #ffffff;
            border: 1px solid var(--chat-borda);
            border-radius: 14px;
            cursor: pointer;
            transition:
                border-color 150ms ease,
                background 150ms ease,
                transform 150ms ease;
        }

        .agente-chat__sugestao:hover {
            color: #222222;
            background: #fafafa;
            border-color: #9d9d9d;
            transform: translateY(-1px);
        }

        .agente-chat__sugestao:focus-visible {
            outline: 3px solid rgba(22, 131, 71, 0.22);
        }

        .agente-chat__sugestao svg {
            width: 24px;
            height: 24px;
            flex: 0 0 auto;
        }

        .agente-chat__sugestao span {
            font-size: 15px;
            line-height: 1.4;
        }

        .agente-chat__voz {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 20px;
            padding: 14px;
            border: 1px dashed #7eb696;
            border-radius: 14px;
        }

        .agente-chat__voz-botao {
            display: flex;
            flex: 1;
            align-items: center;
            min-height: 44px;
            gap: 12px;
            padding: 0;
            color: #484848;
            text-align: left;
            background: transparent;
            border: 0;
            cursor: pointer;
        }

        .agente-chat__voz-botao svg {
            width: 28px;
            height: 28px;
            flex: 0 0 auto;
        }

        .agente-chat__voz-botao span {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .agente-chat__voz-botao strong {
            font-size: 14px;
            line-height: 1.3;
        }

        .agente-chat__voz-botao small {
            color: #717171;
            font-size: 12px;
        }

        .agente-chat__switch {
            position: relative;
            width: 48px;
            height: 28px;
            flex: 0 0 auto;
            cursor: pointer;
        }

        .agente-chat__switch input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .agente-chat__switch-visual {
            position: absolute;
            inset: 0;
            background: #a8a8a8;
            border-radius: 999px;
            transition: background 150ms ease;
        }

        .agente-chat__switch-visual::after {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 20px;
            height: 20px;
            content: "";
            background: #ffffff;
            border-radius: 50%;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.24);
            transition: transform 150ms ease;
        }

        .agente-chat__switch input:checked + .agente-chat__switch-visual {
            background: var(--chat-verde);
        }

        .agente-chat__switch input:checked +
        .agente-chat__switch-visual::after {
            transform: translateX(20px);
        }

        .agente-chat__ilustracao {
            display: grid;
            min-height: 205px;
            place-items: center;
            color: #b3b3b3;
        }

        .agente-chat__ilustracao svg {
            width: 210px;
            height: auto;
            stroke-width: 1.5;
        }

        .agente-chat__mensagens {
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding-bottom: 8px;
        }

        .agente-chat__mensagens[hidden] {
            display: none;
        }

        .agente-chat__mensagem {
            width: fit-content;
            max-width: 92%;
            padding: 13px 15px;
            font-size: 15px;
            line-height: 1.55;
            border-radius: 16px;
            overflow-wrap: anywhere;
        }

        .agente-chat__mensagem--usuario {
            align-self: flex-end;
            color: #ffffff;
            background: var(--chat-verde);
            border-bottom-right-radius: 5px;
            white-space: pre-wrap;
        }

        .agente-chat__mensagem--ia {
            align-self: flex-start;
            color: #303030;
            background: #f5f6f5;
            border: 1px solid #e2e2e2;
            border-bottom-left-radius: 5px;
        }

        .agente-chat__mensagem--erro {
            align-self: flex-start;
            color: #8d2424;
            background: #fff1f1;
            border: 1px solid #f0bebe;
        }

        /*
         * Formatação das respostas em Markdown
         */

        .agente-chat__markdown > :first-child {
            margin-top: 0;
        }

        .agente-chat__markdown > :last-child {
            margin-bottom: 0;
        }

        .agente-chat__markdown h1,
        .agente-chat__markdown h2,
        .agente-chat__markdown h3,
        .agente-chat__markdown h4 {
            margin: 18px 0 8px;
            color: #242424;
            font-weight: 700;
            line-height: 1.3;
        }

        .agente-chat__markdown h1 {
            font-size: 20px;
        }

        .agente-chat__markdown h2 {
            font-size: 18px;
        }

        .agente-chat__markdown h3 {
            font-size: 16px;
        }

        .agente-chat__markdown h4 {
            font-size: 15px;
        }

        .agente-chat__markdown p {
            margin: 0 0 12px;
        }

        .agente-chat__markdown strong {
            font-weight: 700;
        }

        .agente-chat__markdown ul,
        .agente-chat__markdown ol {
            margin: 8px 0 14px;
            padding-left: 22px;
        }

        .agente-chat__markdown li {
            margin-bottom: 6px;
        }

        .agente-chat__markdown li::marker {
            color: var(--chat-verde);
        }

        .agente-chat__markdown blockquote {
            margin: 12px 0;
            padding: 10px 12px;
            color: #4f4f4f;
            background: #ffffff;
            border-left: 4px solid var(--chat-verde);
            border-radius: 0 8px 8px 0;
        }

        .agente-chat__markdown a {
            color: var(--chat-verde-escuro);
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .agente-chat__markdown code {
            padding: 2px 5px;
            color: #20492f;
            font-family:
                Consolas,
                "Courier New",
                monospace;
            font-size: 0.9em;
            background: #e5eee8;
            border-radius: 5px;
        }

        .agente-chat__markdown pre {
            max-width: 100%;
            margin: 12px 0;
            padding: 14px;
            overflow-x: auto;
            color: #f5f5f5;
            background: #242424;
            border-radius: 10px;
        }

        .agente-chat__markdown pre code {
            padding: 0;
            color: inherit;
            background: transparent;
        }

        .agente-chat__markdown hr {
            margin: 16px 0;
            border: 0;
            border-top: 1px solid #d8d8d8;
        }

        .agente-chat__markdown table {
            display: block;
            width: 100%;
            margin: 12px 0;
            overflow-x: auto;
            border-collapse: collapse;
        }

        .agente-chat__markdown th,
        .agente-chat__markdown td {
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #d5d5d5;
        }

        .agente-chat__markdown th {
            background: #e9eeeb;
        }

        .agente-chat__formulario {
            flex: 0 0 auto;
            padding: 14px 20px 10px;
            background: #ffffff;
            border-top: 1px solid #eeeeee;
        }

        .agente-chat__campo {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 52px;
            gap: 10px;
        }

        .agente-chat__campo textarea {
            width: 100%;
            min-height: 52px;
            max-height: 132px;
            padding: 14px 15px;
            resize: none;
            color: #303030;
            font-size: 16px;
            line-height: 1.45;
            background: #ffffff;
            border: 1px solid #c9c9c9;
            border-radius: 12px;
            outline: none;
        }

        .agente-chat__campo textarea::placeholder {
            color: #777777;
        }

        .agente-chat__campo textarea:focus {
            border-color: var(--chat-verde);
            box-shadow: 0 0 0 3px rgba(22, 131, 71, 0.16);
        }

        .agente-chat__enviar {
            display: grid;
            width: 52px;
            height: 52px;
            padding: 12px;
            place-items: center;
            align-self: end;
            color: #ffffff;
            background: var(--chat-verde);
            border: 0;
            border-radius: 12px;
            box-shadow: 0 5px 14px rgba(22, 131, 71, 0.24);
            cursor: pointer;
        }

        .agente-chat__enviar:hover {
            background: var(--chat-verde-escuro);
        }

        .agente-chat__enviar:disabled {
            cursor: wait;
            opacity: 0.6;
        }

        .agente-chat__enviar svg {
            width: 26px;
            height: 26px;
        }

        .agente-chat__atalho {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 8px 2px 0;
            color: #727272;
            font-size: 12px;
            line-height: 1.4;
        }

        .agente-chat__rodape {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            gap: 8px;
            margin: 0 20px 16px;
            padding: 10px 12px;
            color: #5f5f5f;
            background: #f7f7f7;
            border: 1px solid #ededed;
            border-radius: 12px;
            font-size: 13px;
        }

        .agente-chat__rodape svg {
            width: 19px;
            height: 19px;
            flex: 0 0 auto;
        }

        .agente-chat__rodape-confirmacao {
            color: var(--chat-verde);
        }

        .agente-chat__abrir {
            display: flex;
            align-items: center;
            min-height: 56px;
            gap: 10px;
            margin-left: auto;
            padding: 0 20px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            background: var(--chat-verde);
            border: 0;
            border-radius: 999px;
            box-shadow: 0 12px 32px rgba(22, 131, 71, 0.32);
            cursor: pointer;
        }

        .agente-chat__abrir:hover {
            background: var(--chat-verde-escuro);
            transform: translateY(-2px);
        }

        .agente-chat__abrir[hidden] {
            display: none;
        }

        .agente-chat__abrir svg {
            width: 25px;
            height: 25px;
        }

        .agente-chat__label {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            overflow: hidden;
            white-space: nowrap;
            border: 0;
            clip: rect(0, 0, 0, 0);
        }

        @keyframes agenteChatEntrada {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 600px) {
            .agente-chat {
                right: 12px;
                bottom: 12px;
                left: 12px;
            }

            .agente-chat__painel {
                width: 100%;
                height: calc(100dvh - 24px);
                border-radius: 20px;
            }

            .agente-chat__cabecalho {
                min-height: 80px;
                padding: 14px 16px;
            }

            .agente-chat__conteudo {
                padding: 16px;
            }

            .agente-chat__formulario {
                padding: 12px 16px 8px;
            }

            .agente-chat__rodape {
                margin-right: 16px;
                margin-left: 16px;
            }

            .agente-chat__abrir {
                width: 58px;
                min-height: 58px;
                padding: 0;
                justify-content: center;
            }

            .agente-chat__abrir span {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .agente-chat__painel {
                animation: none;
            }

            .agente-chat *,
            .agente-chat *::before,
            .agente-chat *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const painel = document.getElementById('agente-chat-painel');
            const botaoAbrir = document.getElementById('agente-chat-abrir');
            const botaoFechar = document.getElementById('agente-chat-fechar');
            const botaoMinimizar = document.getElementById(
                'agente-chat-minimizar'
            );

            const inicio = document.getElementById('agente-chat-inicio');
            const mensagens = document.getElementById(
                'agente-chat-mensagens'
            );

            const formulario = document.getElementById(
                'agente-chat-formulario'
            );

            const input = document.getElementById('agente-chat-input');
            const botaoEnviar = document.getElementById(
                'agente-chat-enviar'
            );

            const sugestoes = document.querySelectorAll(
                '.agente-chat__sugestao'
            );

            const botaoOuvir = document.getElementById(
                'agente-chat-ouvir'
            );

            const vozAutomatica = document.getElementById(
                'agente-chat-voz-automatica'
            );

            const endpoint = @json(route('agente.perguntar'));
            const csrfToken = @json(csrf_token());

            let ultimaResposta = '';
            let conversaIniciada = false;

            if (window.marked) {
                marked.setOptions({
                    breaks: true,
                    gfm: true,
                });
            }

            function abrirChat() {
                painel.hidden = false;
                painel.setAttribute('aria-hidden', 'false');

                botaoAbrir.hidden = true;
                botaoAbrir.setAttribute('aria-expanded', 'true');

                window.setTimeout(() => input.focus(), 100);
            }

            function fecharChat() {
                painel.hidden = true;
                painel.setAttribute('aria-hidden', 'true');

                botaoAbrir.hidden = false;
                botaoAbrir.setAttribute('aria-expanded', 'false');
                botaoAbrir.focus();

                if ('speechSynthesis' in window) {
                    window.speechSynthesis.cancel();
                }
            }

            function iniciarConversa() {
                if (conversaIniciada) {
                    return;
                }

                conversaIniciada = true;
                inicio.hidden = true;
                mensagens.hidden = false;
            }

            function renderizarMarkdown(texto) {
                if (!window.marked || !window.DOMPurify) {
                    const elemento = document.createElement('div');
                    elemento.textContent = texto;

                    return elemento.innerHTML.replace(/\n/g, '<br>');
                }

                const html = marked.parse(texto);

                return DOMPurify.sanitize(html, {
                    USE_PROFILES: {
                        html: true,
                    },
                });
            }

            function adicionarMensagem(texto, tipo, usarMarkdown = false) {
                iniciarConversa();

                const elemento = document.createElement('article');

                elemento.classList.add(
                    'agente-chat__mensagem',
                    `agente-chat__mensagem--${tipo}`
                );

                if (usarMarkdown) {
                    elemento.classList.add('agente-chat__markdown');
                    elemento.innerHTML = renderizarMarkdown(texto);

                    elemento.querySelectorAll('a').forEach((link) => {
                        link.target = '_blank';
                        link.rel = 'noopener noreferrer';
                    });
                } else {
                    elemento.textContent = texto;
                }

                mensagens.appendChild(elemento);

                window.requestAnimationFrame(() => {
                    mensagens.parentElement.scrollTop =
                        mensagens.parentElement.scrollHeight;
                });

                return elemento;
            }

            function extrairTextoDoMarkdown(markdown) {
                const elemento = document.createElement('div');

                elemento.innerHTML = renderizarMarkdown(markdown);

                return elemento.textContent?.trim() ?? '';
            }

            function falar(texto) {
                if (!texto || !('speechSynthesis' in window)) {
                    return;
                }

                window.speechSynthesis.cancel();

                const fala = new SpeechSynthesisUtterance(
                    extrairTextoDoMarkdown(texto)
                );

                fala.lang = 'pt-BR';
                fala.rate = 1;
                fala.pitch = 1;

                window.speechSynthesis.speak(fala);
            }

            function ajustarAlturaCampo() {
                input.style.height = 'auto';

                input.style.height = `${Math.min(
                    input.scrollHeight,
                    132
                )}px`;
            }

            async function enviarPergunta(pergunta) {
                const mensagem = pergunta.trim();

                if (!mensagem || botaoEnviar.disabled) {
                    return;
                }

                adicionarMensagem(mensagem, 'usuario');

                input.value = '';
                input.disabled = true;
                botaoEnviar.disabled = true;

                ajustarAlturaCampo();

                const carregando = adicionarMensagem(
                    'Consultando o agente...',
                    'ia'
                );

                try {
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            mensagem,
                        }),
                    });

                    const data = await response
                        .json()
                        .catch(() => ({}));

                    carregando.remove();

                    if (!response.ok) {
                        throw new Error(
                            data.message ??
                            'Não foi possível obter uma resposta.'
                        );
                    }

                    if (
                        typeof data.resposta !== 'string' ||
                        !data.resposta.trim()
                    ) {
                        throw new Error(
                            'O agente retornou uma resposta vazia.'
                        );
                    }

                    ultimaResposta = data.resposta;

                    adicionarMensagem(
                        ultimaResposta,
                        'ia',
                        true
                    );

                    if (vozAutomatica.checked) {
                        falar(ultimaResposta);
                    }
                } catch (error) {
                    carregando.remove();

                    adicionarMensagem(
                        error.message ??
                        'Não foi possível conectar ao agente.',
                        'erro'
                    );
                } finally {
                    input.disabled = false;
                    botaoEnviar.disabled = false;
                    input.focus();
                }
            }

            botaoAbrir.addEventListener('click', abrirChat);
            botaoFechar.addEventListener('click', fecharChat);
            botaoMinimizar.addEventListener('click', fecharChat);

            formulario.addEventListener('submit', (event) => {
                event.preventDefault();
                enviarPergunta(input.value);
            });

            sugestoes.forEach((botao) => {
                botao.addEventListener('click', () => {
                    enviarPergunta(botao.dataset.question ?? '');
                });
            });

            input.addEventListener('input', ajustarAlturaCampo);

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    enviarPergunta(input.value);
                }
            });

            botaoOuvir.addEventListener('click', () => {
                if (ultimaResposta) {
                    falar(ultimaResposta);
                    return;
                }

                const aviso =
                    'Ainda não existe uma resposta para ser lida. Faça uma pergunta primeiro.';

                if ('speechSynthesis' in window) {
                    const fala = new SpeechSynthesisUtterance(aviso);
                    fala.lang = 'pt-BR';
                    window.speechSynthesis.speak(fala);
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !painel.hidden) {
                    fecharChat();
                }
            });

            if (!('speechSynthesis' in window)) {
                botaoOuvir.disabled = true;
                vozAutomatica.disabled = true;
            }
        });
    </script>
@endonce