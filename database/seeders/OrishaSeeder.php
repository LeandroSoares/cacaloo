<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orisha;

class OrishaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orishas = [
            // Linha da Fé
            [
                'name' => 'Oxalá',
                'description' => 'O maior dos Orixás, pai de todos os outros Orixás. Representa a paz, a sabedoria e a criação. Sincretizado com Jesus Cristo.',
                'text' => 'Pai Oxalá

Orixá Universal

Oxalá é o Trono Natural da Fé e seu campo de atuação preferencial é a
religiosidade dos seres, aos quais ele envia o tempo todo suas vibrações
estimuladoras da fé individual e suas irradiações geradoras de sentimentos de
religiosidade.
Fé! Eis o que melhor define o Orixá Oxalá. Sim, amamos irmãos na fé em Oxalá. O
nosso amado Pai da Umbanda é o Orixá irradiador da fé em nível planetário e
multidimensional. Oxalá é sinônimo de fé. Ele é o Trono da Fé que, assentado na Coroa
Divina, irradia a fé em todos os sentidos e a todos os seres. Comentar Oxalá é
desnecessário porque ele é a própria Umbanda. Logo, vamos nos afixar nas suas
qualidades, atributos e atribuições.
QUALIDADES: As qualidades de Oxalá são, todas elas, mistérios da Fé, pois ele é o
Trono Divino irradiador da Fé. Nada ou ninguém deixa de ser alcançado por suas
irradiações estimuladoras da fé e da religiosidade. Seu alcance ultrapassa o culto dos
Orixás, pois a religiosidade é comum a todos os seres pensantes. Jesus Cristo é um
Trono da Fé de nível intermediário dentro da hierarquia de Oxalá. E o mesmo acontece
com Buda e outras divindades manifestadoras da fé, pois muitos Tronos Intermediários
já se humanizaram para falar aos homens como homens e, assim, melhor estimularem
a fé em Deus. Todas as divindades irradiam a Fé. Mas os Tronos da hierarquia de
Oxalá são mistérios da Fé e irradiam-na o tempo todo.
ATRIBUTOS: Os atributos de Oxalá são cristalinos, pois é através da essência
cristalina que suas irradiações nos chegam, imantando-nos e despertando em nosso
íntimo os virtuosos sentimentos de fé. Saibam que a essência cristalina irradiada pelo
Divino Trono Essencial da Fé é neutra quando irradiada. Mas como tudo se polariza em
dois tipos de magnetismos, então o pólo positivo e irradiante é Oxalá e o pólo negativo
e absorvente é Oiá. Oxalá irradia fé o tempo todo e Oiá absorve as irradiações
religiosas desordenadas vibradas pelos religiosos desequilibrados. Ela se contrapõe a
ele porque a atuação dela é no sentido de absorver os excessos religiosos vibrados
pelos seres que se excedem nos domínios da fé. Já Oxalá irradia fé e estimula a
religiosidade o tempo todo, a todos.
ATRIBUIÇÕES: As atribuições de Oxalá são as de não deixar um só ser sem o amparo
religioso dos mistérios da Fé. Mas nem sempre o ser absorve suas irradiações quando
está com a mente voltada para o materialismo desenfreado dos espíritos encarnados.
É uma pena que seja assim, porque os próprios seres se afastam da luminosa e
cristalina irradiação do divino Oxalá... E entram nos gélidos domínios da divina Oiá, a
Senhora do Tempo e dos eguns negativados nos aspectos da fé.
OFERENDAS: Oxalá é oferendado com velas brancas, frutas, côco verde, mel e flôres.
Os locais para oferendá-lo são aqueles que mais puros se mostram, tais como:
bosques, campinas, praias limpas, jardins floridos, etc. Já os regentes dos pólos
negativos da linha da Fé não se abrem ao plano material e não são invocados ou
oferendados.',
                'type_orisha' => 'Universal',
                'throne' => 'Fé',
                'oferings' => 'Velas brancas, frutas, côco verde, mel e flôres. Os locais para oferendá-lo são aqueles que mais puros se mostram, tais como: bosques, campinas, praias limpas, jardins floridos, etc.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Oiá',
                'description' => 'Orixá do Tempo, regente cósmica da Fé. Ordenadora do caos religioso.',
                'text' => 'Mãe Oiá

Oiá é a orixá do Tempo e seu campo preferencial de atuação é o religioso,

onde ela atua como ordenadora do caos religioso

O “Tempo” é a chave do mistério da Fé regido pela nossa amada mãe Oiá, porque é na
eternidade do tempo e na infinitude de Deus que todas as evoluções acontecem. A orixá
Oiá forma um pólo magnético vibratório e energético oposto ao do orixá Oxalá, e ambos
regem a linha da Fé, que é a primeira das Sete Linhas de Umbanda, que são as sete
irradiações divinas do nosso Criador. Logo, o campo de atuação de nossa amada mãe
Oiá é o campo da fé, onde flui a religiosidade dos seres, todos em continua evolução.
Oiá é a regente cósmica da linha da Fé, e tempo é o vazio cósmico onde são retidos
todos os espíritos que atentam contra os princípios divinos que sustentam a religiosidade
na vida dos seres.
“Tempo”, eis as qualidades, atributos e atribuições negativas de Oiá, de que tanto
falamos e alertamos aos supostos pais de Santo ou magos negros que recorrem ao
“Tempo” para prejudicar seus semelhantes com seus ebós sujos e suas magias negras.
Oiá é a orixá regente do pólo negativo da linha da Fé, que é a primeira das Sete Linhas
de Umbanda e, com Oxalá assentado em seu pólo positivo, dão sustentação a todas as
manifestações da fé e dão amparo a todos os “sacerdotes” virtuosos e guiados pelos
princípios divinos estimuladores da evolução religiosa dos seres.
Quando Oiá “vira no tempo”, seja contra um seu filho direto quanto um seu filho indireto
(que têm a coroa regida por outros orixás), então sua vidaentra em parafuso e só
deixará de rodar quando esgotar tudo de desregrado e desvirtuado que nela existia. Isto
é Oiá, amados filhos dos orixás! Mãe religiosa por sua excelência divina, mas mãe
rigorosa por sua natureza cósmica, cujo principal atributo junto dos espíritos humanos é
o de esgotar o lobo sanguinário que oculta-se por baixo da pele de cordeiro.
Enquanto Oxalá é irradiante, Oiá é absorvente, e enquanto os filhos de Oxalá são
extrovertidos, os de Oiá são introspectivos e até um tanto tímidos, pois a natureza forte
de sua mãe divina exige deles uma certa “beatitude” 9já que, das mães divinas, ela é a
mais ciumenta por seus filhos amados e a mais rigorosa com os seus filhos relapsos.
Isto é Oiá, amados filhos das nossas amadas mães divinas!
Se ela é assim, é porque ela é a orixá que, junto com Oxalá, rege a primeira linha de
Umbanda, que é a linha da Religiosidade. Logo, os filhos de Umbanda, que têm em
Oxalá o divino Pai da Fé, também devem cultuar a divina mãe Oiá. Com ele no pólo
positivo e ela no pólo negativo, forma-se o par dos orixás excelsos que regem a linha da
Fé e estimulam a religiosidade nos seres.',
                'type_orisha' => 'Cósmico',
                'throne' => 'Fé',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],

            // Linha do Amor
            [
                'name' => 'Oxum',
                'description' => 'Orixá das águas doces, cachoeiras e rios. Representa o amor, a fertilidade, a riqueza e a beleza. Sincretizada com Nossa Senhora da Conceição.',
                'text' => 'Mãe Oxum

Oxum é o Trono irradiador do Amor Divino e da Concepção da Vida em todos os
sentidos. Como “Mãe da Concepção” ela estimula a união matrimonial, e como Trono
Mineral ela favorece a conquista da riqueza espiritual e a abundância material.
A Orixá Oxum é o Trono Regente do pólo magnético irradiante da linha do Amor e atua na vida dos
seres estimulando em cada um os sentimentos de amor, fraternidade e união.
Seu elemento é o mineral e, junto com Oxumaré, forma toda uma linha vertical cujas vibrações,
magnetismo e irradiações planetárias multidimensionais atuam sobre os seres e os estimulam os
sentimentos de amor e acelera a união e a concepção.
Na Coroa Divina, a Orixá Oxum e o Orixá Oxumaré surgem a partir da projeção do Trono do Amor,
que é o regente do sentido do Amor.
Oxum assume os mistérios relacionados à concepção de vidas porque o seu elemento mineral atua
nos seres estimulando a união e a concepção.
Todos devem saber que a água é o melhor condutor das energias minerais e cristalinas. Por esta
sua qualidade única, surgem diversos tipos de água, sendo que a água “doce” dos rios é a melhor
rede de distribuição de energias minerais que temos na face da Terra. E o mar é o melhor
irradiador de energias cristalinas.
Saibam que a energia irradiada pelo mar é cristalina e a energia irradiada pelos rios é mineral. E
justamente neste ponto, surgem confusões quando confundem a Orixá Oxum com Yemanjá.
A energia mineral está presente em todos os seres e também em todos os vegetais. E por isto
Oxum também está presente na linha do Conhecimento, pois sua energia cria a “atração” entre as
células vegetais carregadas de elementos minerais. Já em nível mental, a atuação pelo
conhecimento é uma irradiação carregada de essências minerais ou de sentimento típicos de Oxum,
a concepção em si mesma.
Saibam que a Ciência dos Orixás é tão vasta quanto divina, e está na raiz do todo o saber, na
origem de todas as criações divinas e na natureza de todos os seres. É na Ciência dos Orixás que
as lendas se fundamentam, e não o contrário. Leiam e releiam estes comentários até entenderem
esta magnífica ciência divina e apreenderem suas chaves interpretadoras da ciência dos
entrecruzamentos. Se conseguirem estas duas coisas, temos certeza que daí por diante entenderão
porque a rosa vermelha é usada como presente pelos namorados e a rosa branca é usada é usada
pelos filhos quando presenteiam suas mães. Ou porque se oferece rosas vermelhas para oferendar
pomba-gira, rosas brancas para Yemanjá e rosas amarelas para oferendar Oxum, ou rosas “cor de
rosa” para as crianças (Erês).
Saibam que, se todas são rosas, no entanto os pigmentos que as distinguem são os condutores de
“minerais” e de energias minerais. Para um leigo, todas são rosas. Mas para um conhecedor, cada
rosa é um mistério em si mesma. E o mesmo acontece com cada cor, certo?
Logo, o mesmo acontece com cada Orixá Intermediário, que são mistérios dos Orixás Maiores.
Saibam também que todo jardim com muitas roseiras é irradiador de essências minerais que
tornam o ambiente um catalisador natural das irradiações de amor da divindade planetária que,
amorosamente, chamamos de Mamãe Oxum.
Outra coisa que recomendo aos Umbandistas é: por que vocês, ao invés de oferecerem rosas às
suas Oxuns, não plantam perto das cachoeiras mudas de roseiras? As rosas murcham e logo
apodrecem. Mas uma muda de roseira cresce, floresce, embeleza e vivifica o santuário natural
dessas nossas mães do Amor.
Oferenda: Velas brancas, azuis e amarelas; flores, frutos e essência de rosas; champagne e licor
de cereja, tudo depositado ao pé de uma cachoeira.',
                'type_orisha' => 'Universal',
                'throne' => 'Amor',
                'oferings' => 'Velas brancas, azuis e amarelas; flores, frutos e essência de rosas; champagne e licor de cereja, tudo depositado ao pé de uma cachoeira.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Oxumaré',
                'description' => 'Orixá da renovação e da sexualidade. Diluidor de sentimentos viciados.',
                'text' => 'Pai Oxumaré

Oxumaré é o orixá que rege sobre a sexualidade e seu campo preferencial de atuação é o

da renovação dos seres, em todos os aspectos.

Oxumaré é um dos orixás mais conhecidos, e no entanto é o mais desconhecido dos orixás dentro da
Umbanda, pois os médiuns só cultuam a orixá Oxum, que na linha do Amor ou da Concepção forma
com ele a segunda linha de Umbanda. O aspecto positivo de Oxumaré, que nos chega através das
lendas dos orixás, é que ele simboliza a renovação. Isto é verdadeiro. E o aspecto mais negativo é
que ele é andrógino, ou parte macho e parte fêmea. Mas isto não é verdade. É inadmissível que uma
divindade planetária tenha essas qualidades bissexuais, que só acontecem em seres com disfunções
genéticas que provocam má formação, ou dupla formação, dos órgãos sexuais, e em seres com
desequilíbrios emocionais ou conscienciais que fazem com que, psiquicamente, eles troquem seus
sinais mentais e invertam sua sexualidade.
Portanto, não tem sustentação alguns médiuns, com seus sinais sexuais trocados, alegarem que são
homossexuais porque são filhos de Oxumaré e que ele é um orixá que por seis meses é macho e por
seis meses é fêmea.
Seres humanos com má-formações emocionais, mentais, genéticas ou conscienciais, no afã de se
justificarem, passam às divindades suas vicissitudes humanas e não atentam para um detalhe
fundamental: com seus desequilíbrios, estão desfigurando divindades planetárias que existem no
mundo desde que Deus o criou, que são imutáveis em sua natureza, seja ela masculina ou feminina,
e que regem alguns sentidos dos seres humanos, mas também regem outras dimensões planetárias
paralelas à dimensão humana da vida.
Logo, desumanizaram uma divindade que humanizou algumas de suas qualidades, atributos e
atribuições somente para acelerar nossa evolução e nos conduzir pelo caminho reto. Bastará um
pouco de bom senso para detectar, nesta caracterização negativa de Oxumaré, uma justificativa de
seres com desequilíbrios emocionais, mentais, conscienciais ou genéticos, já que uma divindade é de
natureza positiva ou negativa, ativa ou passiva e masculina ou feminina, mas nunca possui as duas
em si mesma.
Logo, que cultue um Oxumaré andrógino aquele que é desprovido do bom senso, certo? “Quem não
souber valorizar a religiosidade que o libertará da terra, então que pague caro pela religiosidade que
o aprisionará num diletantismo materialista!”
Saibam que é isto que tem feito, e muito bem, este nosso irmão cósmico encarnado que, após ser
afastado da Umbanda, criou todo um culto cuja doutrina, ao invés de pregar os valores maiores de
Jesus Cristo, tem pregado, religiosamente, os seus próprios valores da “mais valia”. E também tem
cobrado de seus fiéis seguidores o justo preço que ele estipulou: tudo o que puder tirar deles para
usar em seu próprio benefício, ou de sua “igreja. Que pague para cultuar Deus quem não aprendeu a
amá-Lo e adorá-Lo de graça! Certo?
Oxumaré, tal como revela a lenda dos orixás , e a renovação continua, mas em todos os aspectos e
em todos os sentidos da vida de um ser. Sua identificação com Dá, a Serpente do Arco-íris, não

aconteceu por acaso, pois Oxumaré irradia as sete cores que caracterizam as sete irradiações divinas
que dão origem às Sete Linhas de Umbanda. E ele atua nas sete irradiações como elemento
renovador. Oxumaré é a renovação do amor na vida dos seres. E onde o amor cedeu lugar à paixão,
ou foi substituído pelo ciúme, então cessa a irradiação de Oxum e inicia-se a dele, que é diluidora
tanto da paixão como do ciúme.
Ele dilui a religiosidade já estabelecida na mente de um ser e o conduz, emocionalmente, a outra
religião, cuja doutrina o auxiliará a evoluir no caminho reto. Ou não é comum os testemunhos dados
pelos neo-convictos no púlpito dos pastores mercantilistas, que dizem quase todos isto:
“Irmãos, quando eu freqüentava a Umbanda, eu fornicava, traia minha esposa e irmãos, gastava
meu ordenado no jogo e nas bebidas, mentia, mas desde que me converti e me entreguei a Jesus,
tudo em minha vida mudou. Hoje vivo para minha esposa e filhos, e para Jesus!”. Sem dúvida,
concordamos nós. Mas... porque o mesmo irmão não ouviu os conselhos recebidos nos centros de
Umbanda, que, se seguidos corretamente, o teriam conduzido pelo caminho reto? Não, ele não só
não deu ouvidos às orientações dos guias e dos pais e mães espirituais, como deu vazão ao seu
emocional e deu inicio ao mau uso do que aprendia dentro de uma religião magística por excelência,
quando solicitava aos exus que fechassem os caminhos de seus desafetos em todos os campos da
vida, além de pedir outras coisas, tais como: mulher, dinheiro, posses, etc. E ele não diz que nasceu
numa família católica e cristã, mas porque era um relapso para as coisas da fé, foi até a Umbanda
para ver se nela se emendava. Como não conseguiu, logo acabou retomando ao reformatório
religioso de Jesus Cristo.
Pois é isto o que são as igrejas evangélicas: reformatórios religiosos onde nosso amado mestre Jesus
recolhe os que nasceram sob sua irradiação luminosa mas não souberam captá-la da forma passiva
como ela é passada pela Igreja Católica. Ele, que é bondade, amor e misericórdia, os conduz às
divindades naturais (que são os orixás), os conduz ao espiritismo e a muitas outras doutrinas para
ver se encontram uma onde suas naturezas ativas absorvam irradiações luminosas.

Mas, quando vê que eles não se adaptam em nenhuma delas, ativa seu pólo cósmico, e um de seus
aspectos negativos logo os arrasta para um de seus reformatórios religiosos, para que eles voltem a
trilhar o caminho reto. E se o aspecto negativo ativado não conseguir reconduzi-los ainda na carne,
não desistirá, mesmo depois de desencarnar.
Renovação, eis a palavra chave que bem define o divino Oxumaré que, em seu aspecto negativo,
tem um mistério escuro chamado por nós de “Sete Cobras” ou “Sete Caminhos Tortuosos”, que é por
onde transitam todos os seres que saíram do caminho reto e entraram nos desvios da vida, que
sempre conduzem aos caminhos da morte. Bem, já falamos sobre vários aspectos do nosso pai
Oxumaré e de nossa amada mãe Oxum, que formam um par energético, magnético, vibratório que
dá formação à segunda linha de Umbanda, que é a linha do Amor ou da Concepção.
Como dissemos, se nos estendêssemos daria um volumoso livro. Por isso encerramos aqui nosso
comentário e vamos ensinar como se deve proceder para oferendar o divino Oxumaré.',
                'type_orisha' => 'Cósmico',
                'throne' => 'Amor',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            // Linha do Conhecimento
            [
                'name' => 'Oxóssi',
                'description' => 'Orixá caçador, senhor das matas e florestas. Representa a fartura, a prosperidade e a sabedoria da natureza. Sincretizado com São Sebastião.',
                'text' => 'Pai Oxóssi

Oxóssi é o caçador por excelência, mas sua busca visa o conhecimento. Logo, é o
cientista e o doutrinador, que traz o alimento da fé e o saber aos espíritos fragilizados
tanto nos aspectos da fé quanto do saber religioso.
O Orixá Oxóssi é tão conhecido que quase dispensa um comentário. Mas não podemos deixar de
fazê-lo, pois falta o conhecimento superior que explica o campo de atuação das hierarquias deste
Orixá regente do pólo positivo da linha do Conhecimento.
O fato é que o Trono do Conhecimento é uma divindade assentada na Coroa Divina, é uma
individualização do Trono das Sete Encruzilhadas e em sua irradiação cria os dois pólos
magnéticos da linha do Conhecimento. O Orixá Oxóssi rege o pólo positivo e a Orixá Obá rege o
pólo negativo.
Oxóssi irradia o conhecimento e Obá o concentra.
Oxóssi estimula e Obá anula.
Oxóssi vibra conhecimento e Obá absorve as irradiações desordenadas dos seres regidos pelos
mistérios do Conhecimento.
Oxóssi é vegetal e Obá é telúrica.
Oxóssi é de magnetismo irradiante e Obá é de magnetismo absorvente.
Oxóssi está nos vegetais e Obá está em sua raiz, como a terra fértil onde eles crescem e se
multiplicam.
Oxóssi é o raciocínio hábil e Obá é o racional concentrador.
OFERENDA:
Velas brancas, verdes e rosa; cerveja, vinho doce e licor de caju; flores do campo e frutas
variadas, tudo depositado em bosques e matas.',
                'type_orisha' => 'Universal',
                'throne' => 'Conhecimento',
                'oferings' => 'Velas brancas, verdes e rosa; cerveja, vinho doce e licor de caju; flores do campo e frutas variadas, tudo depositado em bosques e matas.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Obá',
                'description' => 'Orixá que aquieta e densifica o racional. Absorve conhecimentos desvirtuados.',
                'text' => 'Mãe Oba

Obá é a orixá que aquieta e densifica o racional dos seres, já que seu campo
preferencial de atuação é o esgotamento dos conhecimentos desvirtuados.
Comentar sobre nossa amada mãe Obá é motivo de satisfação, pois, nas lendas,
resumem sua existência ao papel de esposa repudiada por Xangô. Mas, justiça lhe seja
feita, as lendas vêm sendo repetidas a tanto tempo, e às vezes de forma tão
empobrecida pelas transmissões orais que, até como lendas, deixam a desejar e
mostram como é deficiente o conhecimento sobre o campo de ação dos orixás.
Saibam que a orixá Obá que nós conhecemos e aprendemos a amar e reverenciar é uma
divindade regida pelos elementos terra e vegetal, e forma com Oxóssi a terceira linha de
Umbanda Sagrada, que rege o Conhecimento. Oxóssi está assentado no pólo positivo e
irradiante desta linha e Obá está assentada em seu pólo negativo ou cósmico, que é
absorvente.
Esta lenda, na verdade, refere-se a um rei que, como herdeiro das qualidades de Xangô,
tinha várias esposas, que também se apresentavam como herdeiras das qualidades das
orixás femininas. E, se o que esta lenda conta é verdade, no entanto só se refere a
personagens humanos que eram tidos na conta de semideuses. Mas é só, porque esta
história de orixá disputar pelejas tipicamente humanas e carnais, está mais para coisas
humanas de que mistérios divinos. E, não tenham dúvidas de que os orixás são mistérios
divinos que foram, em muitos casos, descaracterizados pelas próprias lendas, que visam
eternizá-los na mente e nos corações humanos.
Saibam que Obá é uma orixá cósmica cujo elemento original é a terra, pois ela é orixá
telúrica por excelência e atua nos seres através do terceiro sentido da vida, que é o
Conhecimento, que desenvolve o raciocínio e a capacidade de assimilação mental da
realidade visível, ou somente perceptível, que influencia nossa vida e evolução continua.
Já o seu segundo elemento é o vegetal. Enquanto o orixá Oxóssi, o mitológico caçador,
estimula a busca do conhecimento (evolução), Obá atrai e paralisa o ser que está se
desvirtuando justamente porque assimilou de forma viciada os conhecimentos puros.
O culto à orixá Obá iniciou-se a quatro milênios atrás com a irradiação simultânea de
uma de suas qualidades ou aspectos, a várias partes do mundo, quando, então, ela se
humanizou.
E se nossa amada mãe Obá já recolheu boa parte de seus filhos encantados que se
espiritualizaram, muitos ainda estão evoluindo nos dois lados da dimensão humana.
Muitos dos seus filhos são, hoje e na Umbanda, alguns dos mais silenciosos exus e das
mais discretas pomba-giras, dos mais aguerridos caboclos e caboclas, resolutos nas suas
ações, precisos nos seus conselhos, e não são de muita conversa quando sentem que o
conhecimento que trazem não é assimilado por seus médiuns ou pelas pessoas que os
consultam.
Agora, deixando os aspectos individuais ou comentários de apoio, o fato é que nossa

amada mãe Obá é uma divindade planetária, regente do pólo negativo da linha do
Conhecimento, que é a terceira linha de forças de Umbanda Sagrada.
Ela e Oxóssi formam esta linha e atuam em pólos opostos: enquanto ele estimula a
busca do conhecimento, ela paralisa os seres que se desvirtuaram justamente porque
adquiriram conhecimentos viciados, distorcidos ou falsos.
O campo onde Obá mais atua é o religioso. Como divindade cósmica responsável por
paralisar os excessos cometidos pelas pessoas que dominam o conhecimento religioso,
uma de suas funções é paralisar os conhecimentos viciados e aquietar os seres antes
que cometam erros irreparáveis.
O ser que está sendo atuado por Obá começa a desinteressar-se pelo assunto que tanto
o atraia e torna-se meio apático, alguns até perdendo sua desvirtuada capacidade de
raciocinar.
Então, quando o ser já foi paralisado e teve seu emocional descarregado dos conceitos
falsos, ai ela o conduz ao campo de ação de Oxóssi, que começará a atuar no sentido de
redirecioná-lo na linha reta do conhecimento.
É certo que esta atuação que descrevemos é a que Obá realiza através do seu aspecto
positivo ou luminoso, por onde fluem suas qualidades, atributos e atribuições positivas.
Mas como todo orixá cósmico, ela também possui seus aspectos negativos, que ativa
sempre que é preciso acelerar a paralisação de um ser que, com seus conhecimentos,
está prejudicando muitas pessoas e atrapalhando suas evoluções pois está induzindo-as
a seguirem em uma direção contrária à que a Lei Maior reservou-lhes.
Saibam que todas as doutrinas religiosas rígidas e rigorosas com seus adeptos têm a
sustentá-las a silenciosa atuação de nossa amada mãe Obá.
Vasto é o campo de atuação de nossa amada mãe Obá e aqui não dá para mostrá-lo
todo. Mas acreditamos que os filhos de Umbanda já entenderam onde e quando ela
atua.
E, porque ela atua de forma silenciosa e vai paralisando os seres que dão mau uso ao
dom do raciocino e aos conhecimentos adquiridos, e atua preferencialmente no campo
religioso, então está na hora de resgatar os aspectos luminosos dessa amada mãe
cósmica e lançar no lixo religioso a lenda que denigre sua imagem humana, pois foi por
amor a nós, espíritos humanos, que ela se humanizou e ajudou a acelerar nossa
evolução.
Que fiquem propagando sua falsa humanização os que um dia haverão de conhecer as
verdades sobre Obá, mas nos domínios de seus aspectos negativos.',
                'type_orisha' => 'Cósmico',
                'throne' => 'Conhecimento',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],

            // Linha da Justiça
            [
                'name' => 'Xangô',
                'description' => 'Orixá da justiça, do fogo e do trovão. Rei poderoso que representa a autoridade, a liderança e o equilíbrio. Sincretizado com São Jerônimo.',
                'text' => 'Pai Xangô

Xangô é o Orixá da Justiça e seu campo preferencial de atuação é a razão, despertando nos
seres o senso de equilíbrio e eqüidade, já que só conscientizando e despertando para os reais
valores da vida a evolução se processa num fluir contínuo.
O Trono Regente Planetário se individualiza nos sete Tronos Essenciais, que projetam-se energética,
magnética e vibratoriamente e criam sete linhas de forças ou irradiações bipolarizadas, pois surgem dois
pólos diferenciados em positivo e negativo, irradiante e absorvente, ativo e passivo, masculino e feminino,
universal e cósmico.
Uma dessas projeções é a do Trono da Justiça Divina que, ao irradiar-se, cria a linha de forças da Justiça,
pontificada por Xangô e Egunitá (divindade natural cósmica do Fogo Divino).
Na linha elemental da Justiça, ígnea por excelência, Xangô e Egunitá são os pólos magnéticos opostos. Por
isto eles se polarizam com a linha da Lei, que é eólica por excelência.
Logo, Xangô polariza-se com a eólica Iansã e Egunitá polariza-se com o eólico Ogum, criando duas linhas
mistas ou linhas regentes do Ritual de Umbanda Sagrada.
O Orixá Xangô é o Trono Natural da Justiça e está assentado no pólo positivo da linha do Fogo Divino, de
onde se projeta e faz surgir sete hierarquias naturais de nível intermediário, pontificadas pelos Xangôs
regentes dos pólos e níveis vibratórios intermediários da linha de forças da Justiça Divina.
Estes sete Xangôs são Orixás Naturais; são regentes de níveis vibratórios; são multidimensionais e são
irradiadores das qualidades, dos atributos e das atribuições do Orixá maior Xangô.
Eles aplicam os aspectos positivos da justiça divina nos níveis vibratórios positivos e polarizam-se com os
Xangôs cósmicos, que são os aplicadores dos aspectos negativos da justiça divina. Como, na Umbanda,
quem lida com os regentes desses aspectos são os Exús e as Pomba-Giras.
Os Xangôs intermediários, tal como todos os Orixás Intermediários, possuem nomes mântricos que não
podem ser abertos ao plano material. Muitos os chamam de Xangô da Pedra Branca, Xangô Sete Pedreiras,
Xangô dos Raios, etc. Enfim, são nomes simbólicos para os mistérios regidos pelos Orixás Xangôs
Intermediários. Só que quem usa estes nomes simbólicos não são os regentes dos pólos magnéticos da linha
da Justiça, e sim os seus intermediadores, que foram “humanizados” e regem linhas de caboclos que
manifestam- se no Ritual de Umbanda Sagrada comandando as linhas de trabalhos de ação e reação. Eles
são os aplicadores “humanos” dos aspectos positivos da justiça divina.
Logo, se alguém disser: “Eu incorporo o Xangô tal”, com certeza está incorporando o seu Xangô individual,
que é um ser natural de 6° grau vibratório, ou um espírito reintegrado às hierarquias naturais regidas por
estes Xangôs. Nem no Candomblé se incorpora um Xangô de nível intermediário ou qualquer outro Orixá
desta magnitude. O máximo que se alcança, em nível de incorporação, é um Orixá de grau intermediador.
Mas no geral, todos incorporam seu Orixá individual natural, ou um espírito reintegrado às hierarquias
naturais e, portanto, um irradiador de um dos aspectos do seu Orixá maior.
Temos, na Umbanda, os: Xangôs da Pedra Branca, Xangôs da Pedra Preta, Xangôs das Sete Pedreiras,
Xangô das Sete Montanhas, etc.
Que são todos eles, Orixás Intermediadores e regentes de subníveis vibratórios ou regentes de pólos
energo-magnéticos cruzados por muitas correntes eletromagnéticas, onde atuam como aplicadores dos
mistérios maiores, mas já em pólos localizados em subníveis vibratórios. E todos estes Xangôs
intermediadores são regentes de imensas linhas de trabalho, ação e reação. Ou não é verdade que temos
caboclos da Pedra Branca, da Pedra Preta, do Fogo, etc.?
Meditem muito sobre o que aqui comentei, pois em se tratando de Orixás, é preciso conhecê-lo a partir da
ciência divina ou nos perdemos no abstracionismo e na imaginação humana. Reflitam bastante e depois
consultem seus mentores espirituais acerca do que aqui estou ensinando, irmão em Oxalá.
Oferenda: Velas brancas, vermelhas e marrom; cerveja escura, vinho tinto e licor de ambrosia; flores
diversas, tudo depositado em uma cachoeira, montanha ou pedreira.',
                'type_orisha' => 'Universal',
                'throne' => 'Justiça',
                'oferings' => 'Velas brancas, vermelhas e marrom; cerveja escura, vinho tinto e licor de ambrosia; flores diversas, tudo depositado em uma cachoeira, montanha ou pedreira.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Egunitá',
                'description' => 'Orixá Cósmico do Fogo e da Justiça Divina. Purificadora dos excessos emocionais.',
                'text' => 'Mãe Egunitá

Egunitá é o Orixá Cósmico aplicador da Justiça Divina na vida dos seres

racionalmente desequilibrados

Fogo, eis o mistério de nossa amada mãe Egunitá, regente cósmica do Fogo e da Justiça
Divina que purifica os excessos emocionais dos seres desequilibrados, desvirtuados e
viciados. Os hindus nos legaram uma divindade cósmica do fogo, punidora das falhas, dos
erros e das paixões humanas por excelência. Kali, no panteão hindu, é uma divindade
temida e evitada por todos os que desconhecem seu mistério e o porquê de sua existência
em oposição à de Agni, o Senhor do Fogo Divino, do fogo da Fé.?
O fato é que todas as irradiações divinas, enquanto são apenas essências, são neutras.
Mas quando se condensam e dão origem aos elementos, ai se polarizam em todos os
sentidos e assumem naturezas bem distintas. Pois aí, no fogo, surgem Agni e Kali. Ele é o
fogo em seu aspecto positivo e ela o é em seu aspecto negativo, ou o fogo da purificação
das ilusões humanas. Agni é o fogo da fé e Kali é o fogo das paixões humanas. Agni é
pólo masculino e Kali é pólo feminino. Agni é passivo e irradiante e Kali é ativa e atratora.
Agni ilumina o ser e Kali o toma rubro. Agni é o raio dourado e Kali é o raio rubro. Agni é
a serpente flamigea da Fé e Kali é a serpente rubra da paixão. Agni é a chama que aquece
e Kali é o braseiro que queima.
Esperamos que tenham entendido que, se recorremos às divindades hindus Agni e Kali, foi
para mostrar como um mesmo elemento possui dois pólos, duas naturezas, duas formas
de nos alcançar e de nos estimular ou de nos paralisar; de acelerar ou paralisar nossa
evolução; de estimular nossa fé ou de esgotar nossos emocionais desequilibrados.
Agora, coloquem no lugar de Agni o nosso amado orixá Xangô e no lugar de Kali a nossa
amada mãe Egunitá e teremos os mesmos aspectos divinos, mas irradiados por divindades
humanizadas em solo africano. Teremos a linha pura do fogo elemental, cujas energias
incandescentes e flamejantes tanto consomem os vícios quanto estimulam o sentimento
de justiça, que são as qualidades, atributos e atribuições de Xangô e Egunitá: aplicar a
Justiça Divina em todos os sentidos da vida!
Afinal, ou entendemos as divindades a partir da ciência ou até o ano 3000 d.C. ainda
estaremos adorando-as somente através dos fenômenos da natureza. E não é isto que
elas desejam de nós, e não foi para isto que deram inicio à sua renovação através da
Umbanda, certo? Nossa mãe Egunitá é fogo puro e suas irradiações cósmicas absorvem o
ar pois seu magnetismo é negativo e atrai este elemento, com o qual se energiza e se
irradia até onde houver ar para dar-lhe esta sustentação energética e elemental.
Como Egunitá (fogo) é feminina, ela se polariza com Ogum (ar), que é masculino e lhe dá
a sustentação do elemento que precisa, mas de forma passiva e ordenada. Só assim suas

irradiações acontecem de forma ordenada e alcançam apenas o objetivo que ela
identificou. Se ela polarizasse com Iansã, suas energias não seriam irradiadas porque
aconteceria uma propagação delas na forma de labaredas, já que as duas são de
magnetismo e elemento feminino. Eis ai a chave das polarizações, que obedecem a uma
ordenação das irradiações através dos magnetismos.
O inverso acontece com Ogum, que é passivo e só se torna ativo em seu segundo
elemento, que é o fogo que o alimenta, aquecendo-o e energizando suas irradiações.
Ogum, enquanto aplicador da Lei, atua nos campos da justiça como aplicador das
sentenças.

Logo, se Ogum absorver o fogo de Xangô, que também é passivo em seu magnetismo,
este fogo só irá consumir o ar de Ogum e não irá gerar a energia ígnea que fluiria como
calor através das irradiações retas do seu magnetismo, que é passivo. Ogum é passivo no
magnetismo eólico e ativo em seu segundo elemento, que é o fogo que energiza (aquece)
o ar. Ogum irradia em linha reta (irradiação continua). Xangô irradia em linha reta
(irradiação continua). Iansã irradia em espirais (irradiação circular). Egunitá irradia por
propagação (irradiação propagada). Xangô polariza com Iansã, e suas irradiações passivas
se tornam ativas no ar (raios); Egunitá polariza com Ogum, e suas irradiações por
propagação magnética assumem a forma de fachos flamejantes.
Observem que Lei e Justiça são inseparáveis e para comentarmos Egunitá temos de
envolver Ogum, Xangô e Iansã, que são os outros três orixás que também se polarizam e
criam campos específicos de duas das Sete Linhas de Umbanda. Ela é cósmica (negativa)
e seu primeiro elemento é o fogo, que se polariza com seu segundo elemento que é o ar.
Portanto, como o fogo é o elemento da linha da Justiça, ela é uma divindade que aplica a
Justiça Divina na vida dos seres. E, porque o ar é o seu segundo elemento, que a alimenta
e energiza e é o elemento da linha da Lei, ela é uma divindade que aplica a justiça como
agente ativa da Lei e consome os vícios emocionais e os desequilíbrios mentais dos seres.
Os vícios emocionais tornam os seres insensíveis à dor alheia. Os desequilíbrios mentais
transformam os seres em tormentos para seus semelhantes. As divindades têm uma
função a realizar e nós sempre seremos beneficiários de sua atuação. Quando nos
paralisam, também estão nos ajudando, pois estão evitando que continuemos trilhando
um caminho que nos conduzirá a um ponto sem retorno. Ela é a executora da Justiça
Divina nos campos da Lei, regidos por Ogum no pólo positivo da linha pura da Lei.',
                'type_orisha' => 'Cósmico',
                'throne' => 'Justiça',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            // Linha da Lei
            [
                'name' => 'Ogum',
                'description' => 'Orixá guerreiro, senhor dos caminhos e do ferro. Protetor dos trabalhadores e daqueles que lutam por justiça. Sincretizado com São Jorge.',
                'text' => 'Pai Ogum

Ogum é o Orixá da Lei e seu campo de atuação é a linha divisória entre a razão e a
emoção. É o Trono Regente das milícias celestes, guardiãs dos procedimentos dos seres
em todos os sentidos.
Ogum é sinônimo de lei e ordem e seu campo de atuação é a ordenação dos processos e dos
procedimentos. O Trono da Lei é eólico e, ao projetar-se, cria a linha pura do ar elemental, já com
dois pólos magnéticos ocupados por Orixás diferenciados em todos os aspectos. O pólo magnético
positivo é ocupado por Ogum e o pólo negativo é ocupado por Iansã. Esta linha eólica pura dá
sustentação a milhões de seres elementais do ar, até que eles estejam aptos a entrar em contato
com um segundo elemento. Uns têm como segundo elemento o fogo, outros têm na água seu
segundo elemento, etc.
Portanto, na linha pura do “ar elemental” só temos Ogum e Iansã como regentes.
Mas se estes dois Orixás são aplicadores da Lei (porque sua natureza é ordenadora), então eles se
projetam e dão início às suas hierarquias naturais, que são as que nos chegam através da Umbanda.
Os Orixás regentes destas hierarquias de Ogum e Iansã são Orixás Intermediários ou regentes dos
níveis vibratórios da linha de forças da Lei.
Saibam que Oxalá tem sete Orixás Intermediários positivos e tem outros sete negativos, que são
seus opostos, e tem sete Orixás neutros; Oxum tem sete Orixás intermediárias positivas e tem
outras sete negativas, que são suas opostas; Oxóssi tem sete Orixás intermediários positivos, sete
negativos, que são seus opostos, e tem sete outros que formam uma hierarquia vegetal neutra e
fechada ao conhecimento humano material; Xangô tem sete Orixás intermediários positivos e tem
sete negativos, que são seus opostos.
E o mesmo acontece com Obaluayê e Yemanjá. Agora, Ogum e Iansã são os regentes do mistério
“Guardião” e suas hierarquias não são formadas por Orixás opostos em níveis vibratórios e pólos
magnéticos opostos, como acontece com outros. Não, senhores! Ogum e Iansã formam hierarquias
verticais retas ou seqüenciais, sem quebra de “estilo” , pois todos os Oguns, sejam os regentes dos
pólos positivos, dos neutros ou tripolares, ou dos negativos, todos atuam da mesma forma e
movidos por um único sentido: aplicadores da Lei!
Todo Ogum é aplicador natural da Lei e todos agem com a mesma inflexibilidade, rigidez e firmeza,
pois não se permitem uma conduta alternativa. Onde estiver um Ogum, lá estarão os olhos da Lei,
mesmo que seja um “caboclo” de Ogum, avesso às condutas liberais dos freqüentadores das tendas
de Umbanda, sempre atento ao desenrolar dos trabalhos realizados, tanto pelos médiuns quanto
pelos espíritos incorporadores.
Dizemos que Ogum é, em si mesmo, os atentos olhos da Lei, sempre vigilante, marcial e pronto
para agir onde lhe for ordenado.
OFERENDA:
Velas brancas, azuis e vermelhas; cerveja, vinho tinto licoroso; flores diversas e cravos, depositados
nos campos, caminhos, encruzilhadas, etc.',
                'type_orisha' => 'Universal',
                'throne' => 'Lei',
                'oferings' => 'Velas brancas, azuis e vermelhas; cerveja, vinho tinto licoroso; flores diversas e cravos, depositados nos campos, caminhos, encruzilhadas, etc.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Iansã',
                'description' => 'Orixá dos ventos, raios e tempestades. Senhora dos eguns (espíritos dos mortos) e guerreira destemida. Sincretizada com Santa Bárbara.',
                'text' => 'Mãe Iansã

Iansã é a aplicadora da Lei na vida dos seres emocionados pelos vícios. Seus
campo preferencial de atuação é o emocional dos seres: ela os esgota e os
redireciona, abrindo-lhes novos campos por onde evoluirão de forma menos

“emocional”.

No comentário sobre o orixá Egunitá já abordamos nossa amada mãe lansã. Logo, aqui
seremos breves em nosso comentário sobre ela, que também foi analisada no capitulo
reservado ao orixá Ogum. Como dissemos antes, lansã, em seu primeiro elemento, e ar
e forma com Ogum um par energético onde ele rege o pólo positivo e é passivo pois
suas irradiações magnéticas são retas. lansã é negativa e ativa, e suas irradiações
magnéticas são circulares ou espiraladas. Observem que lansã se irradia de formas
diferentes: é cósmica (ativa) e é o orixá que ocupa o pólo negativo da linha elemental
pura do ar, onde polariza com Ogum. Já em seu segundo elemento ela polariza com
Xangô, e atua como o pólo ativo da linha da Justiça, que é uma das sete irradiações
divinas.
Na linha da Justiça, lansã é seu aspecto móvel e Xangô é seu aspecto assentado ou
imutável, pois ela atua na transformação dos seres através de seus magnetismos
negativos.
lansã aplica a Lei nos campos da Justiça e é extremamente ativa. Uma de suas
atribuições é colher os seres fora-da-Lei e, com um de seus magnetismos, alterar todo o
seu emocional, mental e consciência, para, só então, redirecioná-lo numa outra linha de
evolução, que o aquietará e facilitará sua caminhada pela linha reta da evolução.
As energias irradiadas por lansã densificam o mental, diminuindo seu magnetismo, e
estimulam o emocional, acelerando suas vibrações. Com isso, o ser se torna mais
emotivo e mais facilmente é redirecionado. Mas quando não é possível reconduzi-lo à
linha reta da evolução, então uma de suas sete intermediárias cósmicas, que atuam em
seus aspectos negativos, paralisam o ser e o retém em um dos campos de esgotamento
mental, emocional e energético, até que ele tenha sido esgotado de seu negativismo e
tenha descarregado todo o seu emocional desvirtuado e viciado.
Nossa amada mãe Iansã possui vinte e uma lansãs intermediárias, que são assim
distribuídas: Sete atuam junto aos pólos magnéticos irradiantes e auxiliam os orixás
regentes dos pólos positivos, onde entram como aplicadoras da Lei segundo os princípios
da Justiça Divina, recorrendo aos aspectos positivos da orixá planetária Iansã.
Sete atuam junto aos pólos magnéticos absorventes e auxiliam os orixás regentes dos
pólos negativos, onde entram como aplicadoras da Lei segundo seus princípios,
recorrendo aos aspectos negativos da orixá planetária Iansã. Sete atuam nas faixas
neutras das dimensões planetárias, onde, regidas pelos princípios da Lei, ou direcionam
os seres para as faixas vibratórias positivas ou os direcionam para as faixas negativas.

Enfim, são vinte e uma orixás lansãs intermediárias aplicadoras da Lei nas Sete Linhas
de Umbanda. Como seus campos preferenciais de atuação são os religiosos, não é de se
estranhar que nossa amada mãe lansã intermediária para a linha da Fé nos campos do
Tempo seja confundida com a própria Oiá, já que é ela quem envia ao tempo os eguns
fora-da-Lei no campo da religiosidade. lansã do Tempo, não tenham dúvidas, tem um
vasto campo de ação e colhe os espíritos desvirtuados nas coisas da Fé, enviando-os ao
Tempo onde serão esgotados.
Mas, não tenham dúvidas, antes ela tenta reequilibrá-los e redirecioná-los, só optando
por enviá-los a um campo onde o magnetismo os esvazia quando vê que um
esgotamento total em todos os sete sentidos é necessário. E isto o Tempo faz muito
bem! Já lansã Bale, do Bale, ou das Almas, é outra intermediária de nossa mãe maior
lansã que é muito solicitada e muito conhecida, porque atua preferencialmente sobre os
espíritos que desvirtuam os princípios da Lei que dão sustentação à vida e, como vida é
geração e Omulu atua no pólo negativo da linha da Geração, então ela envia aos
domínios de Tatá Omulu todos os espíritos que atentaram contra a vida de seus
semelhantes ao desvirtuarem os princípios da Lei e da Justiça Divina.
Logo, seu campo escuro localiza-se nos domínios do orixá Omulu, que rege sobre o lado
de “baixo” do campo santo. Mas também são muito conhecidas as lansãs intermediárias
Sete Pedreiras, dos Raios, do Mar, das Cachoeiras e dos Ventos (lansã pura). As outras
assumem os nomes dos elementos que lhes chegam através das irradiações inclinadas
dos outros orixás, quando surgem as Iansãs irradiantes e multicoloridas. Temos: • uma
Iansã do Ar. • uma Iansã Cristalina. • uma lansã Mineral. • uma Iansã Vegetal. • uma
lansã Ígnea. • uma lansã Telúrica. • uma lansã Aquática. Bom, só por esta amostra dos
múltiplos aspectos de nossa amada regente feminina do ar, já deu para se ter uma idéia
do imenso campo de ação do mistério “Iansã”.
O fato é que ela aplica a Lei nos campos da Justiça Divina e transforma os seres
desequilibrados com suas irradiações espiraladas, que o fazem girar até que tenham
descarregado seus emocionais desvirtuados e suas consciências desordenadas! Não
vamos nos alongar mais, pois muito já foi dito e escrito sobre a “Senhora dos Ventos”.',
                'type_orisha' => 'Cósmico',
                'throne' => 'Lei',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],

            // Linha da Evolução
            [
                'name' => 'Obaluaiyê',
                'description' => 'Orixá da Evolução e das passagens. Senhor da terra e da cura.',
                'text' => 'Pai Obaluaiyê

Obaluaiyê é o Orixá que atua na Evolução e seu campo preferencial é aquele que sinaliza
as passagens de um nível vibratório ou estágio da evolução para outro.
O Orixá Obaluaiyê é o regente do pólo magnético masculino da linha da Evolução, que surge a partir
da projeção do Trono Essencial do Saber ou Trono da Evolução.
O Trono da Evolução é um dos sete Tronos essenciais que formam a Coroa Divina regente do
planeta, e em sua projeção faz surgir, na Umbanda, a linha da Evolução, em cujo pólo magnético
positivo, masculino e irradiante, está assentado o Orixá Natural Obaluaiyê, e em cujo pólo
magnético negativo, feminino e absorvente está assentada a Orixá Nanã Buruquê. Ambos são Orixás
de magnetismo misto e cuidam das passagens dos estágios evolutivos.
Ambos são Orixás terra-água (magneticamente, certo?). Obaluaiyê é ativo no magnetismo telúrico e
passivo no magnetismo aquático. Nanã é ativa no magnetismo aquático e passiva no magnetismo
telúrico. Mas ambos atuam passivamente, o outro atua ativamente, Nanã decanta os espíritos que
irão reencarnar e Obaluaiyê estabelece o cordão energético que une o espírito ao corpo (feto), que
será recebido no útero materno assim que alcança o desenvolvimento celular básico (órgãos físicos).
É o mistério “Obaluaiyê” que reduz o corpo plasmático do espírito até que fique do tamanho do
corpo carnal alojado no útero materno. Nesta redução, o espírito assume todas as características e
feições do seu novo corpo carnal, já formado.
Muito associam o divino Obaluaiyê apenas com o Orixá curador, que ele realmente é, pois cura
mesmo! Mas Obaluaiyê é muito mais do que já o descreveram. Ele é o “Senhor das Passagens” de
um plano para outro, de uma dimensão para a outra, e mesmo do espírito para a carne e vice-versa.
Espero que os Umbandistas deixem de temê-lo e passem a amá-lo e adorá-lo pelo que ele
realmente é: um Trono Divino que cuida da evolução dos seres, das criaturas e das espécies, e que
esqueçam as abstrações dos que se apegaram a alguns de seus aspectos negativos e os usam para
assustar seus semelhantes.
Estes manipuladores dos aspectos negativos do Orixá Obaluaiyê certamente conhecerão os Orixás
cósmicos que lidam com o negativo dele. Ao contrário dos tolerantes Exús da Umbanda, estes
Obaluaiyês cósmicos são intolerantes com quem invoca os aspectos negativos do Orixá maior
Obaluaiyê para atingir seus semelhantes. E o que tem de supostos “pais de Santo” apodrecendo nos
seus pólos magnéticos negativos só porque deram mau uso aos aspectos negativos de Obaluaiyê...
Bem, deixemos que eles mesmos cuidem de suas lepras emocionais. Certo?
Oferenda:
Velas brancas e brancas/pretas; vinho rosé licoroso, água potável; coco fatiado coberto com mel e
pipocas; rosas, margaridas e crisântemos, tudo depositado no cruzeiro do cemitério, á beira-mar ou
á beira de um lago',
                'type_orisha' => 'Universal',
                'throne' => 'Evolução',
                'oferings' => 'Velas brancas e brancas/pretas; vinho rosé licoroso, água potável; coco fatiado coberto com mel e pipocas; rosas, margaridas e crisântemos, tudo depositado no cruzeiro do cemitério, á beira-mar ou á beira de um lago',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Nanã',
                'description' => 'Orixá da maturidade e da decantação. Senhora da sabedoria e dos anciãos.',
                'text' => 'Mãe Nanã

A orixá Nanã rege sobre a maturidade e seu campo preferencial de atuação é o racional
dos seres. Atua decantando os seres emocionados e preparando-os para uma nova

“vida”, já mais equilibrada.

A orixá Nanã Buruquê rege uma dimensão formada por dois elementos, que são: terra e água. Ela é
de natureza cósmica pois seu campo preferencial de atuação é o emocional dos seres que, quando
recebem suas irradiações, aquietam-se, chegando até a terem suas evoluções paralisadas. E assim
permanecem até que tenham passado por uma decantação completa de seus vícios e desequilíbrios
mentais. Nanã forma com Obaluaiyê a sexta linha de Umbanda, que é a linha da Evolução. E
enquanto ele atua na passagem do plano espiritual para o material (encarnação), ela atua na
decantação emocional e no adormecimento do espírito que irá encarnar. Saibam que os orixás Obá
e Omulu são regidos por magnetismos “terra pura”, enquanto Nanã e Obaluaiyê são regidos por
magnetismos mistos “terra-água”. Obaluaiyê absorve essência telúrica e irradia energia elemental
telúrica, mas também absorve energia elemental aquática, fraciona-a em essência aquática e a
mistura à sua irradiação elemental telúrica, que se torna “úmida”. Já Nanã, atua de forma inversa:
seu magnetismo absorve essência aquática e a irradia como energia elemental aquática; absorve o
elemento terra e, após fracioná-lo em essência, irradia-o junto com sua energia aquática.
Estes dois orixás são únicos, pois atuam em pólos opostos de uma mesma linha de forças e, com
processos inversos, regem a evolução dos seres. Enquanto Nanã decanta e adormece o espírito que
irá reencarnar, Obaluaiyê o envolve em uma irradiação especial, que reduz o corpo energético, já
adormecido, até o tamanho do feto já formado dentro do útero materno onde está sendo gerado .
lEste mistério divino que reduz o espírito ao tamanho do corpo carnal, ao qual já está ligado desde
que ocorreu a fecundação do óvulo pelo sêmen, é regido por nosso amado pai Obaluaiyê, que é o
“Senhor das Passagens” de um plano para outro.
Já nossa amada mãe Nanã, envolve o espírito que irá reencarnar em uma irradiação única, que dilui
todos os acúmulos energéticos, assim como adormece sua memória, preparando-o para uma nova
vida na carne, onde não se lembrará de nada do que já vivenciou. É por isso que Nanã é associada
à senilidade, à velhice, que é quando a pessoa começa a se esquecer de muitas coisas que
vivenciou na sua vida carnal. Portanto, um dos campos de atuação de Nanã é a “memória” dos
seres. E, se Oxóssi aguça o raciocínio, ela adormece os conhecimentos do espírito para que eles
não interfiram com o destino traçado para toda uma encarnação.
Em outra linha da vida, ela é encontrada na menopausa. No inicio desta linha está Oxum
estimulando a sexualidade feminina; no meio está Yemanjá, estimulando a maternidade; e no fim
está Nanã, paralisando tanto a sexualidade quanto a geração de filhos.
Nas “linhas da vida”, encontramos os orixás atuando através dos sentidos e das energias. E cada
um rege uma etapa da vida dos seres.
Logo, quem quiser ser categórico sobre um orixá, tome cuidado com o que afirmar, porque onde
um de seus aspectos se mostra, outros estão ocultos. E o que está visível nem sempre é o principal
aspecto em uma linha da vida. Saibam que Nanã em seus aspectos positivos forma pares com
todos os outros treze orixás, mas sem nunca perder suas qualidades “água-terra”. Já em seus
aspectos negativos, bem, como a Umbanda não lida com eles, que os comente quem lidar, certo?',
                'type_orisha' => 'Cósmico',
                'throne' => 'Evolução',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],
            // Linha da Geração
            [
                'name' => 'Iemanjá',
                'description' => 'Rainha do mar e mãe de todos os Orixás. Protetora das águas salgadas, da maternidade e da família. Sincretizada com Nossa Senhora dos Navegantes.',
                'text' => 'Mãe Yemanjá

Yemanjá é o Trono feminino da Geração e seu campo preferencial de

atuação é no amparo à maternidade.
Yemanjá é por demais conhecida e não nos alongaremos ao comentá-la.
O fato é que o Trono Essencial da Geração assentado na Coroa Divina projeta-se e faz
surgir, na Umbanda, a linha da Geração, em cujo pólo magnético positivo está
assentada a Orixá Natural Yemanjá, e em cujo pólo magnético negativo está assentado
o Orixá Omulu.
Yemanjá, a nossa amada Mãe da Vida é a água que vivifica e o nosso amado pai
Omulu é a terra que amolda os viventes. Como dedicamos um comentário extenso ao
Orixá Omulu, vamos nos concentrar em Yemanjá.
Yemanjá rege sobre a geração e simboliza a maternidade, o amparo materno, a mãe
propriamente. Ela se projeta e faz surgir sete pólos magnéticos ocupados por sete
Yemanjás intermediarias, que são as regentes dos níveis vibratórios positivos e são as
aplicadoras de seus aspectos, todos positivos, pois Yemanjá não possui aspectos
negativos.
Estas sete Yemanjás são intermediárias e comandam incontáveis linhas de trabalho
dentro da Umbanda. Suas Orixás intermediadoras estão espalhadas por todos os níveis
vibratórios positivos, onde atuam como mães da “criação”, sempre estimulando nos
seres os sentimentos maternais ou paternais.
Todas atuam a nível multidimensional e projetam-se também para a dimensão
humana, onde têm muitas de suas filhas estagiando. Todas têm suas hierarquias de
Orixás Yemanjás intermediadoras, que regem hierarquias de espíritos religados às
hierarquias naturais.

OFERENDA:
Velas brancas; azuis e rosas; champagne, calda de ameixa ou de pêssego, amnjar,
arroz-doce e melão; rosas e palmas brancas, tudo depositado à beira-mar.',
                'type_orisha' => 'Universal',
                'throne' => 'Geração',
                'oferings' => 'Velas brancas; azuis e rosas; champagne, calda de ameixa ou de pêssego, amnjar, arroz-doce e melão; rosas e palmas brancas, tudo depositado à beira-mar.',
                'is_right' => true,
                'is_left' => false,
                'active' => true,
            ],
            [
                'name' => 'Omulú',
                'description' => 'Orixá da morte e da paralisação da vida. Guardião dos espíritos caídos.',
                'text' => 'Pai Omulú

Omulú é o orixá que rege a morte, ou no instante da passagem do plano material para o

plano espiritual (desencarne)

É com tristeza que temos visto o temor dos irmãos umbandistas quando é mencionado o nome do
nosso amado Pai Omulu. E no entanto descobrimos que este medo é um dos frutos amargos que nos
foram legados pelos ancestrais semeadores dos orixás em solo brasileiro, pois difundiram só os dois
extremos do mais caridoso dos orixás, já que Omulu é o guardião divino dos espíritos caídos. O orixá
Omulu guarda para Olorum todos os espíritos que fraquejaram durante sua jornada carnal e
entregaram-se à vivenciação de seus vícios emocionais. Mas ele não pune ou castiga ninguém, pois
estas ações são atributos da Lei Divina, que também não pune ou castiga. Ela apenas conduz cada um
ao seu devido lugar após o desencarne. E se alguém semeou ventos, que colha sua tempestade
pessoal, mas amparado pela própria Lei, que o recolhe a um dos sete domínios negativos, todos
regidos pelos orixás cósmicos, que são magneticamente negativos. E Tatá Omulu é um desses
guardiões divinos que consagrou a si e à sua existência, enquanto divindade, ao amparo dos espíritos
caídos perante as leis que dão sustentação a todas as manifestações da vida..
Esta qualidade divina do nosso amado pai foi interpretada de forma incorreta ou incompleta, e o que
definiram no decorrer dos séculos foi que Tatá Omulu é um dos orixás mais “perigosos” de se lidar, ou
um dos mais intolerantes, e isto quando não o descrevem como implacável nas suas punições.
Ele, na linha da Geração, que é a sétima linha de Umbanda, forma um par energético, magnético e
vibratório com nossa amada mãe Yemanjá, onde ela gera a vida e ele paralisa os seres que atentam
contra os princípios que dão sustentação às manifestações da vida. Em Tatá Omulu descobri o amor de
Olorum, pois é por puro amor que uma divindade consagra-se por inteiro ao amparo dos espíritos
caídos. E foi por amor a nós que ele assumiu a incumbência de nos paralisar em seus domínios,
sempre que começássemos a atentar contra os princípios da vida. Enquanto a nossa mãe Yemanjá
estimula em nós a geração, o nosso pai Omulu nos paralisa sempre que desvirtuamos os atos
geradores.
Mas esta “geração” não se restringe só à hereditariedade, já que temos muitas faculdades além desta,
de fundo sexual. Afinal, geramos idéias, projetos, empresas, conhecimentos, inventos, doutrinas,
religiosidades, anseios, desejos, angústias, depressões, fobias, leis, preceitos, princípios, templos, etc.
Temos a capacidade de gerar muitas coisas, e se elas estiverem em acordo com os princípios
sustentados pela irradiação divina, que na Umbanda recebe o nome de “linha da Geração” ou “sétima
linha de Umbanda”, então estamos sob a irradiação da divina mãe Yemanjá, que nos estimula.
Mas, se em nossas “gerações”, atentarmos contra os princípios da vida codificados como os únicos
responsáveis pela sua multiplicação, então já estaremos sob a irradiação do divino pai Omulu, que nos
paralisará e começará a atuar em nossas vidas, pois deseja preservar-nos e nos defender de nós
mesmos, já que sempre que uma ação nossa for prejudicar alguém, antes ela já nos atingiu, feriu e
nos escureceu, colocando-nos em um de seus sombrios domínios. Ele é o excelso curador divino pois
acolhe em seus domínios todos os espíritos que se feriram quando, por egoísmo, pensaram que
estavam atingindo seus semelhantes. E, por amor, ele nos dá seu amparo divino até que, sob sua
irradiação, nós mesmos tenhamos nos curado para retomarmos ao caminho reto trilhado por todos os
espíritos amantes da vida e multiplicadores de suas benesses.

Todos somos dotados dessa faculdade, já que todos somos multiplicadores da vida, seja em nós
mesmos, através de nossa sexualidade seja nas idéias, através de nosso raciocínio, assim como
geramos muitas coisas que tornam a vida uma verdadeira dádiva divina. Tatá Omulu, em seu pólo
positivo, é o curador divino e tanto cura alma ferida quanto nosso corpo doente. Se orarmos a ele
quando estivermos enfermos ele atuará em nosso corpo energético, nosso magnetismo, campo
vibratório e sobre nosso corpo carnal, e tanto poderá curar-nos quanto nos conduzir a um médico que
detectará de imediato a doença e receitaria medicação correta.
O orixá Omulu atua em todos os seres humanos, independente de qual,. seja a sua religião. Mas esta
atuação geral e planetária processa-se através de, uma faixa vibratória especifica e exclusiva, pois é
através dela que fluem as irradiações divinas de um dos mistérios de Deus, que nominamos de
“Mistério da Morte”. Tatá Omulu, enquanto força cósmica e mistério divino, é a energia que se
condensa em torno do fio de prata que une o espírito e seu corpo físico, e o dissolve no momento do
desencarne ou passagem de um plano para o outro.
Neste caso ele não se apresenta como o espectro da morte coberto com manto e capuz negro,
empunhando o alfanje da morte que corta o fio da vida. Esta descrição é apenas uma forma simbólica
ou estilizada de se descrever a força divina que ceifa a vida na carne. Na verdade, a energia que
rompe o fio da vida na carne é de cor escura, e tanto pode parti-lo num piscar de olhos quando a
morte é natural e fulminante, como pode ir se condensando em torno dele, envolvendo-o todo até
alcançar o espírito, que já entrou em desarmonia vibratória porque a passagem deve ser lenta,
induzindo o ser a aceitar seu desencarne de forma passiva.
O orixá Omulu atua em todas as religiões e em algumas é nominado de “Anjo da Morte” e em outras
de divindade ou “Senhor dos Mortos”. No antigo Egito ele foi muito cultuado e difundido e foi dali que
partiram sacerdotes que o divulgaram em muitas culturas de então.

Mas com o advento do Cristianismo seu culto foi desestimulado já que a religião cristã recorre aos
termos “anjo” e “arcanjo” para designar as divindades. Logo, nada mais lógico do que recorrer ao
arquétipo tão temido do “Anjo da Morte”, todo coberto de preto e portando o alfanje da morte, para
preencher a lacuna surgida com o ostracismo do orixá ou divindade responsável por este momento tão
delicado na vida dos seres.
O culto a Tatá Omulu surgiu entre os negros levados como escravos ao antigo Egito, que o
identificaram como um orixá e o adaptaram às suas culturas e religiões. Com o tempo, ele foi, a partir
desse sincretismo, assumindo sua forma definitiva, até que alcançou o grau de divindade ligada à
morte, à medicina e às doenças. Já em outras regiões da África, este mistério foi assumindo outras
feições e outros orixás semelhantes surgiram, foram cultuados e se humanizaram. “Humanizar-se”
significa que o orixá ou a divindade assumiu feições humanas, compreensíveis por nós e de mais fácil
assimilação e interpretação.
Tatá Omulu não vibra menos amor por nós do que qualquer um dos outros orixás e está assentado na
Coroa Divina, pois é um dos Tronos de Olorum, o Divino Criador. Atotô, meu pai!',
                'type_orisha' => 'Cósmico',
                'throne' => 'Geração',
                'oferings' => null,
                'is_right' => false,
                'is_left' => true,
                'active' => true,
            ],

        ];

        foreach ($orishas as $orishaData) {
            Orisha::updateOrCreate(
                ['name' => $orishaData['name']],
                $orishaData
            );
        }

        $this->command->info('Orixás criados com sucesso!');
        $this->command->info('Total de Orixás: ' . count($orishas));
        $this->command->info('Linha da Direita: ' . collect($orishas)->where('is_right', true)->where('is_left', false)->count());
        $this->command->info('Linha da Esquerda: ' . collect($orishas)->where('is_left', true)->where('is_right', false)->count());
        $this->command->info('Ambas as linhas: ' . collect($orishas)->where('is_right', true)->where('is_left', true)->count());
    }
}
