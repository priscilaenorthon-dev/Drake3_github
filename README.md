# Drake3 - Sistema de Gerenciamento

![Drake3 Logo](https://img.shields.io/badge/Drake3-v1.0.0-blue)
![Status](https://img.shields.io/badge/status-ready-green)

## 📋 Sobre o Projeto

Drake3 é um sistema moderno de gerenciamento e controle desenvolvido com tecnologias web. O sistema oferece uma interface intuitiva e responsiva para gerenciamento de tarefas, visualização de dados e controle de projetos.

## ✨ Recursos Principais

- **Dashboard Interativo**: Visualize estatísticas e métricas em tempo real
- **Gerenciador de Tarefas**: Adicione, complete e exclua tarefas facilmente
- **Interface Responsiva**: Funciona perfeitamente em desktop, tablet e mobile
- **Design Moderno**: Interface clean e profissional
- **Performance Otimizada**: Carregamento rápido e experiência fluida

## 🚀 Como Usar

### Visualização Local

1. Clone o repositório:
```bash
git clone https://github.com/priscilaenorthon-dev/Drake3_github.git
cd Drake3_github
```

2. Abra o arquivo `index.html` em seu navegador preferido:
   - Duplo clique no arquivo `index.html`, ou
   - Abra via terminal: `open index.html` (Mac) ou `start index.html` (Windows)

### Usando um Servidor Local

Para uma melhor experiência, recomendamos usar um servidor local:

```bash
# Usando Python 3
python3 -m http.server 8000

# Usando Python 2
python -m SimpleHTTPServer 8000

# Usando Node.js (npx)
npx serve

# Usando PHP
php -S localhost:8000
```

Depois acesse: `http://localhost:8000`

## 📱 Funcionalidades

### 1. Página Inicial (Hero)
- Apresentação clara do sistema
- Call-to-action para acessar o dashboard

### 2. Recursos
- Análise de dados em tempo real
- Sistema seguro e protegido
- Performance otimizada
- Design responsivo

### 3. Dashboard
- **Estatísticas**: Visualize métricas importantes como:
  - Usuários ativos
  - Tarefas concluídas
  - Projetos ativos
  - Receita
  
- **Gerenciador de Tarefas**: 
  - Adicione novas tarefas
  - Marque tarefas como concluídas
  - Exclua tarefas
  - Dados salvos localmente no navegador

### 4. Contato
- Formulário de contato funcional
- Validação de campos
- Feedback visual de envio

## 🛠️ Tecnologias Utilizadas

- **HTML5**: Estrutura semântica
- **CSS3**: Estilização moderna com:
  - CSS Grid e Flexbox
  - Variáveis CSS
  - Animações e transições
  - Design responsivo
- **JavaScript**: Funcionalidades interativas:
  - Manipulação do DOM
  - LocalStorage para persistência
  - Event handling
  - Smooth scrolling

## 📂 Estrutura do Projeto

```
Drake3_github/
│
├── index.html          # Página principal
├── styles.css          # Estilos CSS
├── app.js             # Lógica JavaScript
└── README.md          # Documentação
```

## 🎨 Personalização

### Cores
As cores podem ser facilmente modificadas no arquivo `styles.css` através das variáveis CSS:

```css
:root {
    --primary-color: #2563eb;
    --secondary-color: #1e40af;
    --success-color: #10b981;
    /* ... outras variáveis */
}
```

### Conteúdo
Para modificar o conteúdo, edite o arquivo `index.html` e ajuste os textos conforme necessário.

## 📊 Testes

O sistema foi testado em:
- ✅ Google Chrome (versão 120+)
- ✅ Firefox (versão 120+)
- ✅ Safari (versão 17+)
- ✅ Microsoft Edge (versão 120+)
- ✅ Dispositivos móveis (iOS e Android)

## 🔒 Segurança

- Escape de HTML para prevenir XSS
- Validação de formulários
- Sem dependências externas que possam comprometer a segurança

## 📈 Próximos Passos

- [ ] Integração com backend
- [ ] Autenticação de usuários
- [ ] API REST para persistência de dados
- [ ] Testes automatizados
- [ ] Modo escuro
- [ ] Internacionalização (i18n)

## 👥 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests.

## 📄 Licença

Este projeto está sob a licença MIT.

## 📞 Contato

Para mais informações ou suporte, utilize o formulário de contato no site ou entre em contato através do GitHub.

---

**Desenvolvido com ❤️ para apresentação ao cliente**