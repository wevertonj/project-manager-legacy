# Project Manager (Legacy)

Um conjunto de 3 ferramentas que eu usava para gerenciar meus projetos, quando trabalhava como freelancer.

Estas ferramentas foram mantidas entre **2017** e começo de **2020**, portanto, todo o código é antigo e não foi revisado.

Como eram para uso interno, não me preocupei em manter o código limpo, na época nem me preocupava muito com isso 😁, então está pior do que normalmente estaria.

E como é uma base de código antiga, não me importei muito com as credenciais que possam conter no código, afinal, nenhuma delas funcionam mais.

## Ferramentas

### 1. Gerador de Projeto

Arquivo: `gerador.php`

Esta ferramenta fazia a cópia de uma instalação WordPress, com o tema e plugins que eu usava, e também fazia a configuração do banco de dados.

Era uma ferramenta bem simples, na prática, apenas copiava os arquivos, sendo necessário fazer todo o processo de instalação do WordPress no banco de dados (já conectado) e ativação do tema e plugins.

### 2. Atualizador

Arquivo: `atualizador.php`

Esta ferramenta gerava um arquivo zip com o tema, substituindo algumas tags previamente definidas com as informações passadas no formulário, salvava este arquivo em uma pasta local de um site que eu usava como "plataforma" de distribuição de atualizações para WordPress, além de gerar a query para atualizar o banco de dados. Assim eu só precisava subir o zip no servidor e executar a query no banco de dados.

### 3. Feedback

Arquivo: `feedback.php`

Um simples sorteador de avaliações de clientes, que eu usava na plataforma em que pegava os projetos.

Esta ferramenta tem um form para o nome do cliente e opções de tags, tudo previamente escrito no código, ao clicar em "Gerar", o sistema filtrava as tags e dava um `shuffle` nos arrays que sobravam.

Haviam planos para evoluir esta ferramenta, conectando a um banco de dados, adicionando variações de gênero, talvez até evoluindo para um app real, mas acabou sendo abandonado após eu ter deixado de trabalhar como freelancer.
