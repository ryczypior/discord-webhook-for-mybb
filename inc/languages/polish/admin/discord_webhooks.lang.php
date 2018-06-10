<?php

/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2017 Łukasz Kodzis (Ryczypiór)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction, 
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or substantial 
 * portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE 
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
$l['discord_webhook_name'] = 'Discord Webhooks dla forum MyBB';
$l['discord_webhook_description'] = 'Wysyła informacje o nowych wątkach i postach używsając Discord Webhooks';
$l['discord_webhook_settinggroups_title'] = 'Discord Webhooks dla MyBB';
$l['discord_webhook_settinggroups_description'] = 'Ustawienia wtyczki Discord Webhooks.';
$l['discord_webhooks_enabled'] = 'Wtyczka aktywna';
$l['discord_webhooks_enabled_description'] = 'Czy wtyczka jest włączona?';
$l['discord_webhooks_url'] = 'Domyślny URL do Discord Webhooks';
$l['discord_webhooks_url_description'] = 'Adres URL końcówki Discord Webhooks utworzonej na stronie opcji generowanie Webhooks w kliencie Discord (URL podobny do: https://discordapp.com/api/webhooks/XXX/YYY)';
$l['discord_webhooks_usesocket'] = 'Używaj sockets';
$l['discord_webhooks_usesocket_description'] = 'Wysyłaj wiadomości do Discord używając sockets zamiast cURL';

$l['discord_webhooks_forums'] = 'Dostępne fora';
$l['discord_webhooks_forums_description'] = 'Fora, z których informacje o nowych wątkach/postach są wysyłane.';
$l['discord_webhooks_botname'] = 'Nazwa BOTa Discord';
$l['discord_webhooks_botname_description'] = 'Podaj domyślną nazwę BOTa, która ma być wyświetlana przy wiadomości. Możesz użyć dodatkowych parametrów:<br><strong>{username}</strong> - nazwa użytkownika,<br><strong>{pole_z_tabeli_użytkownika_w_bazie_danych}</strong> jakiekolwiek pole znajdujące się w tabeli użytkownika bazy danych,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> jakiekolwiek DODATKOWE pole użytkownika gdzie <strong style="color: #d60000">N</strong> to ID dodatkowego pola,<br><strong>{@<span style="color: #d60000">Nazwa Pola</span>}</strong> jakiekolwiek dodatkowe pole użytkownika, gdzie <strong style="color: #d60000">Nazwa Pola</strong> oznacza nazwę pola w tabeli dodatkowych danych użytkownika';
$l['discord_webhooks_ignored_forums'] = 'Ignorowane działy';
$l['discord_webhooks_ignored_forums_description'] = 'Działy, z których wątki i posty mają być ignorowane';
$l['discord_webhooks_ignored_usergroups'] = 'Ignorowane grupy użytkowników';
$l['discord_webhooks_ignored_usergroups_description'] = 'Grupy użytkowników, których wątki i posty będą ignorowane';

$l['discord_webhooks_new_registration_enabled'] = 'Wysyłaj informacje o nowych rejestracjach użytkowników';
$l['discord_webhooks_new_registration_enabled_description'] = 'Czy wysyłać informacje o nowych rejestracjach użytkowników?';
$l['discord_webhooks_new_registration_message'] = 'Treść wiadomości o nowej rejestracji';
$l['discord_webhooks_new_registration_message_description'] = 'Treść wiadomości dotycząca nowej rejestracji użytkownika. Możesz użyć parametrów:<br><strong>{uid}</strong> - numer ID zarejestrowanego konta,<br><strong>{username}</strong> - nazwa użytkownika,<br><strong>{date FORMAT}</strong> - data rejestracji, możesz ustawić format daty jak przy funkcji <em>strftime</em>, więcej informacji: <a href="http://php.net/manual/en/function.strftime.php" target="_blank">http://php.net/manual/en/function.strftime.php</a>';
$l['discord_webhooks_new_registration_message_value'] = 'Nowy użytkownik - **{username}** - zarejestrował się w dniu **{date %d.%m.%Y o godzinie %H:%M:%S}**';
$l['discord_webhooks_new_registration_show_style'] = 'Pokaż informację jako';
$l['discord_webhooks_new_registration_show_style_description'] = 'Wybierz metodę wyświetlania';
$l['discord_webhooks_new_registration_show_style_n0'] = 'Zwykła wiadomość';
$l['discord_webhooks_new_registration_show_style_n1'] = 'Wiadomość w postaci Rich Text';
$l['discord_webhooks_new_registration_color'] = 'Kolor dla belki przy wiadomości o nowej informacji o rejestracji';
$l['discord_webhooks_new_registration_color_description'] = '<strong>Ta właściwość działa tylko dla typu <em>Wiadomość w postaci Rich Text</em> metody wyświetlania!!!</strong> Musisz podać kolor RGB w postaci wartości hexadecymalnej, np. #CC9977';
$l['discord_webhooks_new_registration_url'] = 'URL do Discord Webhook dla informacji o rejestracji';
$l['discord_webhooks_new_registration_url_description'] = 'Adres URL końcówki Discord Webhooks tylko dla wiadomości o rejestracji. Jeśli nie został podany, a wysyłanie informacji o rejestracji zostało zaznaczone, zostanie użyty domyślny adres URL';
$l['discord_webhooks_new_registration_botname'] = 'Nazwa BOTa Discord dla nowych rejestracji użytkownika';
$l['discord_webhooks_new_registration_botname_description'] = 'Podaj nazwę BOTa, która ma być wyświetlana przy wiadomości o rejestracji. Jeśli nazwa nie zostanie podana, domyślna nazwa BOTa zostanie użyta. Możesz użyć dodatkowych parametrów:<br><strong>{username}</strong> - nazwa użytkownika,<br><strong>{pole_z_tabeli_użytkownika_w_bazie_danych}</strong> jakiekolwiek pole znajdujące się w tabeli użytkownika bazy danych,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> jakiekolwiek DODATKOWE pole użytkownika gdzie <strong style="color: #d60000">N</strong> to ID dodatkowego pola,<br><strong>{@<span style="color: #d60000">Nazwa Pola</span>}</strong> jakiekolwiek dodatkowe pole użytkownika, gdzie <strong style="color: #d60000">Nazwa Pola</strong> oznacza nazwę pola w tabeli dodatkowych danych użytkownika';

$l['discord_webhooks_new_thread_enabled'] = 'Wysyłaj informacje o nowych wątkach';
$l['discord_webhooks_new_thread_enabled_description'] = 'Czy wysyłać informacje o nowych wątkach?';
$l['discord_webhooks_new_thread_message'] = 'Wiadomość o nowym wątku';
$l['discord_webhooks_new_thread_message_description'] = 'Zawartość wiadomości o nowym wątku. Możesz użyć:<br><strong>{username}</strong> - nazwa autora wątku,<br><strong>{title}</strong> - tytuł wątku,<br><strong>{boardname}</strong> - nazwa działu,<br><strong>{url}</strong> adres URL wątku';
$l['discord_webhooks_new_thread_message_value'] = '@{username} utworzył(-a) nowy wątek *{threadtitle}* - {url} w dziale *{boardname}*';
$l['discord_webhooks_new_thread_color'] = 'Kolor etykiety dla nowego wątku';
$l['discord_webhooks_new_thread_color_description'] = 'Musisz wskazać kolor RGB w wartości heksadecymalnej, np. #CC9977';
$l['discord_webhooks_show'] = 'Sposób wyświetlania informacji';
$l['discord_webhooks_show_description'] = 'Wybierz sposób wyświetlania informacji o nowym wątku';
$l['discord_webhooks_show_n0'] = 'Tylko informacja';
$l['discord_webhooks_show_n1'] = 'informacja oraz wiadomość rozszerzona (autor, tytuł, tekst obcięty do wartości ustawionej w polu Maksymalna ilość znaków w treści rozszerzonej)';
$l['discord_webhooks_show_n2'] = 'Wiadomość rozszerzona (treść informacji zostanie dołączona do wiadomości) (autor, tytuł, tekst obcięty do wartości ustawionej w polu Maksymalna ilość znaków w treści rozszerzonej)';
$l['discord_webhooks_show_n3'] = 'Wiadomość rozszerzona (bez treści informacyjnej) (autor, tytuł, tekst obcięty do wartości ustawionej w polu Maksymalna ilość znaków w treści rozszerzonej)';
$l['discord_webhooks_show_n4'] = 'Tylko treść informacyjna przedstawiona jako wiadomość rozszerzona';
$l['discord_webhooks_new_thread_chars_limit'] = 'Wątki - limit znaków wiadomości';
$l['discord_webhooks_new_thread_chars_limit_description'] = 'Dotyczy tylko wyświetlania wiadomości rozszerzonej. Jeśli wpisano 0 lub mniej dane (jak avatar, tytuł, itp) zostaną wysłane ale bez tekstu opisowego. Proszę brać pod uwagę to, że limit wiadomości Discorda to 2000 znaków! Zalecane jest ustawienie limitu poniżej tej wartości';
$l['discord_webhooks_new_thread_url'] = 'URL dla Discord Webhook dla informacji o nowych wątkach';
$l['discord_webhooks_new_thread_url_description'] = 'Adres URL końcówki Discord Webhooks tylko dla informacji o nowych wątkach. Jeśli nie został podany, a wysyłanie informacji o nowych wątkach zostało zaznaczone, zostanie użyty domyślny adres URL';
$l['discord_webhooks_new_thread_botname'] = 'Nazwa BOTa Discord dla nowych wątków';
$l['discord_webhooks_new_thread_botname_description'] = 'Podaj nazwę BOTa, która ma być wyświetlana przy wiadomości o nowym wątku. Jeśli nazwa nie zostanie podana, domyślna nazwa BOTa zostanie użyta. Możesz użyć dodatkowych parametrów:<br><strong>{username}</strong> - nazwa użytkownika,<br><strong>{pole_z_tabeli_użytkownika_w_bazie_danych}</strong> jakiekolwiek pole znajdujące się w tabeli użytkownika bazy danych,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> jakiekolwiek DODATKOWE pole użytkownika gdzie <strong style="color: #d60000">N</strong> to ID dodatkowego pola,<br><strong>{@<span style="color: #d60000">Nazwa Pola</span>}</strong> jakiekolwiek dodatkowe pole użytkownika, gdzie <strong style="color: #d60000">Nazwa Pola</strong> oznacza nazwę pola w tabeli dodatkowych danych użytkownika';
$l['discord_webhooks_new_thread_prefix'] = 'Przesyłaj komunikaty tylko dla wątków/postów o podanych prefixach';
$l['discord_webhooks_new_thread_prefix_description'] = 'Pozostaw puste dla każdego prefixu (także dla żadnego). Wstaw prefixy rozdzielone przecinkiem, by ograniczyć informacje o wysyłanych wątkach lub postach do tych, które są oznaczone jednym z tych prefixów.';
$l['discord_webhooks_new_thread_show_avatar'] = 'Wątki - Pokazuj avatar użytkownika jako avatar bota';
$l['discord_webhooks_new_thread_show_avatar_description'] = 'Czy chcesz pokazywać avatar użytkownika jako avatar BOTa?';
$l['discord_webhooks_new_thread_show_title'] = 'Wątki - Rich Text - Pokazuj tytuł';
$l['discord_webhooks_new_thread_show_title_description'] = 'Czy chcesz pokazywać sekcję tytułu dla typu Rich Text?';
$l['discord_webhooks_new_thread_show_thumbnail'] = 'Wątki - Rich Text - Pokazuj avatar użytkownika jako miniaturkę przy wiadomości';
$l['discord_webhooks_new_thread_show_thumbnail_description'] = 'Czy chcesz pokazywać avatar użytkownika (jeśli jest dostępny) jako miniaturkę do wiadomości dla typu Rich Text?';
$l['discord_webhooks_new_thread_show_author'] = 'Wątki - Rich Text - Pokazuj informacje o autorze wątku';
$l['discord_webhooks_new_thread_show_author_description'] = 'Czy chcesz wyświetlać informacje o autorze dla typu Rich Text?';

$l['discord_webhooks_new_post_enabled'] = 'Wysyłaj informacje o nowych postach';
$l['discord_webhooks_new_post_enabled_description'] = 'Czy wysyłać informacje o nowych postach?';
$l['discord_webhooks_new_post_message'] = 'Wiadomość o nowym poście';
$l['discord_webhooks_new_post_message_description'] = 'Zawartość wiadomości o nowym poście. Możesz użyć:<br><strong>{username}</strong> - nazwa autora posta,<br><strong>{posttitle}</strong> - tytuł posta,<br><strong>{threadtitle}<strong> - tytuł wątku,<br><strong>{boardname}</strong> - nazwa działu,<br><strong>{url}</strong> adres URL posta,<br><<strong>{pole_z_tabeli_użytkownika_w_bazie_danych}</strong> jakiekolwiek pole znajdujące się w tabeli użytkownika bazy danych,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> jakiekolwiek DODATKOWE pole użytkownika gdzie <strong style="color: #d60000">N</strong> to ID dodatkowego pola,<br><strong>{@<span style="color: #d60000">Nazwa Pola</span>}</strong> jakiekolwiek dodatkowe pole użytkownika, gdzie <strong style="color: #d60000">Nazwa Pola</strong> oznacza nazwę pola w tabeli dodatkowych danych użytkownika';
$l['discord_webhooks_new_post_message_value'] = '@{username} napisał nowy post *{posttitle}* - {url} na forum *{boardname}*';
$l['discord_webhooks_new_post_show'] = 'Sposób wyświetlania informacji';
$l['discord_webhooks_new_post_show_description'] = 'Wybierz sposób wyświetlania informacji o nowym poście';
$l['discord_webhooks_new_post_color'] = 'Kolor etykiety dla nowego posta';
$l['discord_webhooks_new_post_color_description'] = 'Musisz wskazać kolor RGB w wartości heksadecymalnej, np. #CC9977';
$l['discord_webhooks_new_post_chars_limit'] = 'Posty - limit znaków wiadomości';
$l['discord_webhooks_new_post_chars_limit_description'] = 'Dotyczy tylko wyświetlania wiadomości rozszerzonej. Jeśli wpisano 0 lub mniej dane (jak avatar, tytuł, itp) zostaną wysłane ale bez tekstu opisowego. Proszę brać pod uwagę to, że limit wiadomości Discorda to 2000 znaków! Zalecane jest ustawienie limitu poniżej tej wartości';
$l['discord_webhooks_new_post_url'] = 'URL dla Discord Webhook dla informacji o nowych postach';
$l['discord_webhooks_new_post_url_description'] = 'Adres URL końcówki Discord Webhooks tylko dla informacji o nowych postach. Jeśli nie został podany, a wysyłanie informacji o nowych postach zostało zaznaczone, zostanie użyty domyślny adres URL';
$l['discord_webhooks_new_post_botname'] = 'Nazwa BOTa Discord dla nowych postów';
$l['discord_webhooks_new_post_botname_description'] = 'Podaj nazwę BOTa, która ma być wyświetlana przy wiadomości o nowym poście. Jeśli nazwa nie zostanie podana, domyślna nazwa BOTa zostanie użyta. Możesz użyć dodatkowych parametrów:<br><strong>{username}</strong> - nazwa użytkownika,<br><strong>{pole_z_tabeli_użytkownika_w_bazie_danych}</strong> jakiekolwiek pole znajdujące się w tabeli użytkownika bazy danych,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> jakiekolwiek DODATKOWE pole użytkownika gdzie <strong style="color: #d60000">N</strong> to ID dodatkowego pola,<br><strong>{@<span style="color: #d60000">Nazwa Pola</span>}</strong> jakiekolwiek dodatkowe pole użytkownika, gdzie <strong style="color: #d60000">Nazwa Pola</strong> oznacza nazwę pola w tabeli dodatkowych danych użytkownika';
$l['discord_webhooks_new_post_show_avatar'] = 'Posty - Pokazuj avatar użytkownika jako avatar bota';
$l['discord_webhooks_new_post_show_avatar_description'] = 'Czy chcesz pokazywać avatar użytkownika jako avatar BOTa?';
$l['discord_webhooks_new_post_show_title'] = 'Posty - Rich Text - Pokazuj tytuł';
$l['discord_webhooks_new_post_show_title_description'] = 'Czy chcesz pokazywać sekcję tytułu dla typu Rich Text?';
$l['discord_webhooks_new_post_show_thumbnail'] = 'Posty - Rich Text - Pokazuj avatar użytkownika jako miniaturkę przy wiadomości';
$l['discord_webhooks_new_post_show_thumbnail_description'] = 'Czy chcesz pokazywać avatar użytkownika (jeśli jest dostępny) jako miniaturkę do wiadomości dla typu Rich Text?';
$l['discord_webhooks_new_post_show_author'] = 'Posty - Rich Text - Pokazuj informacje o autorze wątku';
$l['discord_webhooks_new_post_show_author_description'] = 'Czy chcesz wyświetlać informacje o autorze dla typu Rich Text?';
