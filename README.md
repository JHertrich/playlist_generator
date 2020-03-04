Projekt im Rahmen einer Weiterbildung durch die IBB

Projektbeschreibung

Ziel des Projekts „PlaylistGen“ war die Erstellung einer dynamischen Webseite, die der automatischen Generierung von Musik-Playlists anhand eines Interpret-Suchbegriffs seitens der User der Website dient. 
Basierend auf dem Suchbegriff führt die Webseite HTTP- Requests an die Web API des populären Streaming Diensts Spotify durch und gibt dem User der Website eine Playlist mit dem jeweiligen Top-Song von 20 stilistisch ähnlichen Interpreten zurück. 
Top Songs und ähnliche Interpreten basieren auf Spotify’s Statistiken.
Der User kann einen Musik-Interpreten seiner Wahl in einem Suchfeld eingeben. Die Suchfunktion sendet anhand des Interpreten-Namens mittels Javascript einen Ajax (HTTP-)Request an die Spotify API. 
Dabei wird die Interpreten ID und basierend auf dieser, die als „ähnlich“ gelisteten Interpreten und deren Top-Song ermittelt. Diese 20 Top-Songs werden per Javascript in das DOM (Document Object Model) eingefügt und so dem User angezeigt. 
Die HTTP-Requests bedienen sich der Spotify Web API JS von JM Perez (https:// github.com/JMPerez/spotify-web-api-js), einer Library, die Helferfunktionen für alle Spotify API Endpunkte enthält. Die Library wurde als Paket per npm (Node) installiert.
Die Webseite bietet weiterhin die Option, User-Playlists in einer MariaDB Datenbank abspeichern zu können. Dies erfordert jedoch die Registrierung des Users und einen anschließenden Login. 
Die Signup/Login Formulare werden durch jQuery und PHP validiert. Das Datenbank-Handling erfolgt mittels PHP (objektorientiert).

Ausblick

Die Webseite soll nach Abschluss des Projekts weiterhin mit neuen Funktionen ausgestattet werden. 
Dem User soll ermöglicht werden, die generierte Playlist optional - direkt von der Webseite aus - seinem Spotify Account hinzufügen zu können. 
Die Anmeldung des Users in seinem Spotify Account über die PlaylistGen Webseite soll gemäß den Spotify Richtlinien (oAuth Autorisierung) integriert werden. 
Weiterhin soll ein User-Bereich implementiert werden, der dem Aufruf der in der Datenbank der Webseite hinterlegten Playlists dient. 
Da die generierten Playlists (Songtitel und Interpreten) bisher nur textbasiert sind, ist die Integration des Spotify Web Players in die Website geplant um ein direktes Abspielen der Songs zu ermöglichen.
