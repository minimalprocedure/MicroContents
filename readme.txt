struttura dell'archivio:

\images\
\lib\
\locale\
\setting\
\style\
\index.php
\phpinfo.php
\template_base.html
\version

il file index.php è il modello base che processa le richieste,
gli si possono passare due variabili in modalità GET: lang e content.

Il valore di lang può essere uno dei codici iso possibili.
Il valore di content è numerico e va da 1 al numero.

Nella caretella lib lo script php vero e proprio.

La cartella setting è inutilizzata per adesso.
Dentro style gli stili css che regolano la renderizzazione della pagina.

Il file phpinfo.php se invocato serve solo per sapere varie cose sul php nel server,inutilizzato direttamente.

Il file template_base.html è il modello xhtml transitional valido usato per la pagina,inutilizzato direttamente.

Il file version contiene la versione. :)

La cartella locale contiene varie cartelle tutte che hanno per nome i vari codici iso per le lingue, per esempio it, en etc...

Dentro le cartelle ci sono vari file di testo:

contact.txt
content-1.txt
content-2.txt
content-3.txt
content-4.txt
content-5.txt
content-6.txt
content-7.txt
content-8.txt
languages.txt
menu.txt
meta.txt
name.txt

la struttura è semplice:

++chiave++
++valore++

per esempio il file contact.txt:

    ++contact++
    ++contatti++

    ++sede++
    ++sede++

    ++mobile++
    ++mobile++

    ++email++
    ++email++

    ++corporate_text++
    ++Hanami Solutions++

    ++sede_text++
    ++via dell'artigiano 12,<br />
    Baiano di Spoleto (PG)<br />
    CAP 06040++

    ++mobile_text++
    +++39.339-6691847++

    ++email_text++
    ++info@hanamisolutions.it++


Il file contact.txt regola i campi del box destro.

I vari file content-x.txt regolano i contenuti del box principale richiamabili dai link sul menu principale.

Il file languages.txt regola le lingue attive, la chiave importante per l'attivazione è

    ++languages++
    ++it;en++

come vedi in questo caso le lingue attive sono it e en per attivare italiano, inglese  e tedesco:

    ++languages++
    ++it;en;de++

Il file menu.txt regola le voci del menu principale.
Il file meta.txt i metatag da attivare.
Il file name.txt ha le voci principali che sono sulla banda superiore.

possibili due classi di immagini: LEFT e RIGHT


