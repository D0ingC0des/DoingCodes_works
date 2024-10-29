# DoingCodes_works
# S.C.P.E. - Sistema de controle de portaria e encomendas

## Descrição

Site criado para o controle de portarias em geral. Com nosso sistema, você pode cadastrar encomendas, ocorrências, acessos, prestadores de serviço, retiradas de objetos, etc. 
É possível controlar as baixas e entregas, além de realizar consultas e atualizações em geral. O sistema é seguro, contando com criptografia nos dados sensíveis. 
Os funcionários do condomínio efetuam login para acessar o sistema, e todas as ações executadas possuem registro de quem as executou. 
Além disso, o S.C.P.E. conta com um sistema de notificações que avisa os moradores sobre suas encomendas e avisos em geral, utilizando o WhatsApp do condomínio e/ou e-mail.

## Detalhes

- Redução de Despesas com Papelaria:
Em um ano de uso, o condomínio que utiliza nosso sistema, economizou 133 cadernos de protocolos para correspondência. Com mais de 16 mil encomendas cadastradas, a economia total foi significativa.
- Economia com Livros de Ocorrências:
Durante o mesmo período, foram economizados 6 livros de ocorrências.
- Economia Geral na Portaria:
Considerando outras despesas relacionadas à portaria, a economia total ao utilizar o SCPE foi de aproximadamente R$ 5.000,00 em pouco mais de um ano.
- Agilidade
Ao utilizar o SCPE o cadastro de informações é rápido e seguro, organizando e agilizando o serviço de portaria por completo. Graças ao SCPE a perca de informações em portarias foi sanada.
- Segurança e Backup dos Dados:
O SCPE é um sistema seguro, com criptografia (AES-256-CBC), que traz mais segurança ao dados salvos no sistema. Os dados são protegidos e há backup regular para garantir a integridade das informações.
E o fato de não precisar usar internet para operar o sistema, o torna mais seguro.
- Sem telas de loading
O SCPE utiliza o sistema de “fluxo continuo”, aonde todo o processamento das informações é feito sem as intermináveis telas de loading. O que agiliza mais ainda a utilização do sistema.
- Suporte
O SCPE possui suporte durante o período da licença, qualquer problema relacionado ao aplicativo será resolvido.
Em resumo, o SCPE oferece uma solução eficiente para gerenciar correspondências, ocorrências, acessos de moradores, visitantes, prestadores de serviço e custos em condomínios e empresas, promovendo maior organização
e economia.

## Funcionalidades

Cadastros, Baixas, Consultas e Atualizações para:
- Encomendas (com aviso de recebimento por WhatsApp e e-mail);
- Ocorrências em geral;
- Ocorrências de elevadores;
- Retiradas de objetos;
- Prestadores de serviço (com foto);
- Funcionários de apartamentos (com foto);
- Moradores (com foto e mensagem de boas vindas por WhatsApp e e-mail);
- Funcionários do condomínio (com foto e mensagem de boas vindas por WhatsApp e e-mail);
- Avisos em geral;
- Código IFood;
- Pedidos de tags veiculares;
- Locação de espaços (extra - deve ser solicitado na contratação);
- Consulta de vagas por apartamento;
- Registro de visitantes (com nome, data, hora e apto);
- Validação de CPF cadastrado para moradores, empregados dos aptos, funcionários do condomínio e prestadores de serviço;
- Areas exclusivas na aplicação para configuração geral do sistema, area de monitoramento em tempo real das atividades dentro da aplicação, area de moradores;
- A area de moradores permite locação de espaço (se houver necessidade), criação de avisos, ocorrências, além de possibilitar ao morador verificar se foi recebido algo em seu nome.


## Tecnologias Utilizadas

- **Frontend**: *HTML, CSS, JS, JQUERY.*
- **Backend**: *PHP, JSON, XML, AJAX.*
- **Banco de Dados**: *MYSQL.*

## Vantagens

Constatamos nos condomínios que usam nosso sistema uma economia relevante no uso de materiais de portaria, tais como cadernos de protocolo e ocorrência. 
Além disso, houve uma redução de 90% no tempo utilizado com registros e consultas em geral. O sistema também pode ser totalmente adaptado às necessidades do seu condomínio. 
Com um sistema limpo, utilizando o padrão de 'fluxo contínuo' e removendo todas as telas de loading, os processos foram totalmente otimizados, agilizando ainda mais os serviços de portaria e recepção. 
Números impressionantes foram alcançados, em apenas 1 condomínio que utiliza nosso sistema, foram registradas mais de 16.000 encomendas em pouco mais de 14 meses de uso. 
Além de vários outros registros que ficam armazenados e podem ser consultados a qualquer momento. Uma única licença de nossa aplicação pode servir a vários usuários na mesma rede.

## Uso

A aplicação é de uso simples, qualquer pessoa pode operar o sistema. Com poucos *cliques* é realizado um cadastro ou baixa. O sistema utiliza um servidor Apache com Php e MySQL, e através de IP é possivel o acesso
de vários usuários ao sistema, o que possibilita o uso em condomínios com mais de uma portaria ou guarita.
Indicamos o sistema para condomínios horizontais e verticais.

*Exemplo de uso*

- Para cadastrar uma encomenda: Menu Cadastro->Encomendas->Selecionar o apartamento->Informar os dados selecionando morador, tipo de encomenda e código de rastreio->Enviar
Ao clicar em *enviar* a encomenda é cadastrada no banco de dados e em seguida o morador selecionado recebe por WhatsApp a notificação que a encomenda está na portaria.
- Para informar a entrega de uma encomenda: Menu Baixas->Encomendas->Selecionar o apartamento->Clicar na checkbox da encomenda entregue
Ao clicar na checkbox, a encomenda é registrada como entregue e é registrada a hora e data da entrega e responsavel.
- Para cadastrar acesso de visitante: Atalho Registrar visitante->Informar nome, apartamento e detalhes (caso haja algo a informar como entrada com pet, etc)->Clicar em cadastrar visita
A visita é registrada com os dados informados.
- Para criar avisos para os funcionários: Atalho Criar Aviso->Informar data de criação de aviso, data de validade do aviso em dias, texto do aviso->Por fim cadastrar aviso
Ao cadastrar aviso ele fica visivel a todos os funcionários durante o periodo informado. Os avisos são usados para informar ausencia de moradores, instruções de trabalho, modificações, alertas, etc.


## Licença

O uso do S.C.P.E. é regido pelos seguintes termos:

- **Duração**: A licença para uso do S.C.P.E. é válida por 1 ano a partir da data de aquisição.
- **Custo**: A licença anual possui um custo associado, que deve ser quitado no momento da aquisição. Os valores e formas de pagamento são detalhados na documentação de aquisição.
- **Renovação**: A licença pode ser renovada anualmente mediante pagamento da taxa de renovação correspondente.
- **Adições de Conteúdo**: Qualquer adição de conteúdo ao programa pode ser feita sob solicitação, porém, está sujeita a custos adicionais. Os detalhes sobre esses custos estão disponíveis mediante consulta.
- **Suporte**: Durante o período de licença, suporte técnico está disponível. Detalhes sobre o suporte oferecido podem ser encontrados na documentação de suporte.

---

Desenvolvido com por [Doing Codes](https://github.com/D0ingC0des)

Experimente o [S.C.P.E. ](https://scpe-web-v2.rf.gd/) *Recomendamos EDGE para melhor aproveitar o sistema*

*Log-in: root_adm*

*Senha: 5231*

## ATENÇÂO

*O site do S.C.P.E. foi disponibilizado em versão de teste. O site com todas as funções é fornecido ao condomínio que contrar o serviço.*
