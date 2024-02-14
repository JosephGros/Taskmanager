# U04-Taskmanager

Det här är min **U04-ToDoApp**! <br>
Med denna app kan du skapa en egen användare och sedan ha din egen lista med tasks. Man kan då skapa sina egna tasks där man får skriva in en titel som den ska ha och sedan en beskrivning av den. Sedan när du trycker på *create task* så kommer den att skapas och sparas i databasen och sedan finnas i din lista. Alla har egna personliga tasks så en användare kan endast komma åt sina egna tasks. När du väl har en task i din lista kan du välja att updatera den genom att trycka på en knapp så kan du döpa om den eller annat. Eller så kan du klar markera den vilket kommer berätta för databasen att den är klar så loggar du ut och sedan in kommer den fortfarande att vara klar markerad. Du kan markera alla dina tasks med en knapp. Sedan kan du radera dina tasks en för en eller välja att radera alla som är markerade med bara ett knapp tryck! Så om vi tar det steg för steg. 

## Innehållsförteckning
- [Vad kan du göra på Taskmanager](#vad-kan-du-göra-på-taskmanager)

- [Hur kan man då använda den här appen?](#hur-kan-man-då-använda-den-här-appen)

- [ER diagram för detta projekt](#er-diagram-för-detta-projekt)

### Vad kan du göra på Taskmanager
1. Du kan skapa en helt egen användare med unikt användarnamn och email med en toggle för att kunna se lösenordet:
<br><br>
<img src=./src/img/taskmanager1.png height=250>
<br><br>
2. Du kan sedan logga in på din användare. Där det också finns en toggle för att kunna se lösenordet:
<br><br>
<img src=./src/img/taskmanager2.png height=250> <img src=./src/img/taskmanager3.png height=250>
<br> <br>
3. Sedan är du på hemskärmen där du kan välja att gå precis vart du vill men med två specifika knappar för att antingen se dina tasks eller skapa en ny:
<br><br>
<img src=./src/img/taskmanager4.png height=250>
<br><br>
4. Men om vi då väljer att göra en task kommer det att se ut såhär. Där man kan skriva in sin titel och beskrivning för sin task för att sedan trycka på **Create task**:
<br><br>
<img src=./src/img/taskmanager5.png height=250>
<br><br>
5. När man då trycker på **Create task** blir man vidare skickad till **My tasks** där man kan se alla sina skapade tasks samt den precis skapade. Här finns det flera olika alternativ. Man kan redigera en task, markera eller avmarkera en task, markera alla, radera tasks, eller radera alla markerade tasks. Men också skapa en ny task:
<br><br>
<img src=./src/img/taskmanager6.png height=250>
<br><br>
6. Men om vi väljer att **edit** en task så kommer vi att få fram ett formulär precis som när man skapar en task bara att den här har den informationen som fanns i tasken sedan innan så att man kan redigera den. Sedan när man trycker på update task kommer man bli skickad tillbaka till sin lista med tasks med en uppdaterad task:
<br><br>
<img src=./src/img/taskmanager7.png height=250>
<br><br>
7. Sen finns det en sista funktion i denna app vilket är om man kollar uppe i menyn så har man ju en meny som kan låta en göra alla de här grejerna. Men man kan också se att det står taskmanager med användarens **username**. Trycker man där hamnar man på en *user settings page*. Här kan man då se sin information samt välja att radera sitt konto om man nu vill det. Eller skapa en ny task: 
<br><br>
<img src=./src/img/taskmanager8.png height=250>
<br><br>


## Hur kan man då använda den här appen?

Jo det ska vi gå igenom steg för steg hur vi får igång denna app. Till och börja med se till att ni har **Docker** installerat på er dator och ni är inloggade och klara. 

1. Först vill vi då gå in på terminalen. *(powershell, gitbash vilket som funkar för windows). 
<br><br>
2. Där vill vi skapa en mapp för denna app så att vi har någonstans att clone detta repo. Det gör vi genom att använda mkdir i den önskade mappen för att skapa en ny. 
<br><br>
3. Nu vill vi vara här på github och där trycker vi på den gröna knappen och sedan kopiera den länken:
<br><br>
<img src=./src/img/link.png height="200">
<br><br>
4. Sedan i terminalen kör vi en 'git clone *länk*' i den mappen som vi vill ha appen i. 
<br><br>
5. Nu när vi har clonat ner den så kan vi öppna projektet med VScode. I VScode kommer vi att nere till vänster trycka på den blåa lådan. Då kommer vi få upp några förslag uppe i rutan. Där väljer vi reopen in container. **Glöm inte att Docker måste vara igång!**
<br><br>
<img src=./src/img/vscode.png height="250">
<br><br>
6. Nu kan vi gå in på docker och dubbelkolla att allt ät igång för denna container. Då vill vi att det ska se ut såhär. Glöm inte att stänga andra pågående containers om ni nu har det.
<br><br>
<img src=./src/img/docker.png>
<br><br>
7. Nu kan vi öppna en terminal i VScode och skriva in 'php -S localhost:80'. Då kommer den att köra igång en server på din dator och det kommer att komma upp ett meddelande till höger där man kan trycka *open in browser* så kommer programmet att öppnas i din webbläsare.
<br><br> 
8. Sista steget är att skapa en användare och köra igång!

<br><br>

## ER diagram för detta projekt

Här har vi ett **ER diagram** som gjordes innan så att jag hade en tydlig bild för hur **databasen** skulle se ut.
<br><br>
<img src=./src/img/ERdiagram.png>
<br><br>
Här ser vi tydligt att det ska vara en tabell för *User* och en tabell för *Task*. 

I **user** ska det finnas: 
- **userId** som är en **primary key**. 
- **username**
- **firstName**
- **lastName**
- **email**
- **password**

I **task** ska det finnas: 
- **taskId** som är en **primary-key**
- **taskTitle**
- **taskDescription**
- **taskStatus** för att kunna sätta en status för klarmarkering.
- **taskUserId** som är en **foreign-key**. För att kunna koppla **userId** med denna task.
#   T a s k m a n a g e r  
 