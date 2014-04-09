<?php
/*
 * russian.php
 *
 * Description:	 w3mail - Language File.
 * Developed by: Alexander Djourik <sasha@iszf.irk.ru>
 *		 Anton Gorbunov <anton@iszf.irk.ru>
 *		 Pavel Zhilin <pzh@iszf.irk.ru>
 *
 * Copyright (c) 2002,2003,2004,2005 Alexander Djourik. All rights reserved.
 *
 * Initially based on code from 6XMailer - A PHP POP3 mail reader,
 * Copyright 2001 6XGate Systems, Inc. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License.
 *
 * Please see the file LICENSE in this directory for full copyright
 * information.
 *
 */

// Set locale to Russian
setlocale (LC_ALL, 'ru_RU.UTF-8');

// Titles
// -----------------------------------
// The titles used for the mail pages.

$TITLE_System = "Почтовая система";
$TITLE_SystemName = "ПОЧТОВАЯ СИСТЕМА W3MAIL";
$TITLE_Login = "Авторизация";
$TITLE_Interface = "Интерфейс";
$TITLE_Compose = "Создание сообщения";
$TITLE_Settings = "Настройки";
$TITLE_Help = "Помощь";
$TITLE_About = "О программе";
$TITLE_Addresses = "Адресная книга";

// Login Prompt Texts
// ----------------------------------------------------------
// These are used to label the login forms and message boxes.

$PROMPT_Username = "Имя:";
$PROMPT_Password = "Пароль:";
$PROMPT_Language = "Язык:";

// Buttons
// ---------------------------------------
// These are used to label varius buttons.

$BUTTON_OK = "Да";
$BUTTON_Cancel = "Отмена";
$BUTTON_Login = "Вход";
$BUTTON_About = "О программе...";
$BUTTON_Reply = "Ответить";
$BUTTON_Forward = "Переслать";
$BUTTON_Redirect = "Перенаправить";
$BUTTON_Delete = "Удалить";
$BUTTON_Headers = "Заголовки";
$BUTTON_Attachments = "Вложения";
$BUTTON_Yes = "Да";
$BUTTON_No = "Нет";
$BUTTON_Send = "Отправить";
$BUTTON_Edit = "Изменить";
$BUTTON_ContactAdd = "Новая запись";
$BUTTON_ContactSave = "Сохранить запись";
$BUTTON_SendTo = "Письмо";
$BUTTON_Settings = "Настройки";
$BUTTON_SettingsSave = "Сохранить настройки";

// Icons
// -------------------------------
// These are labels for the icons.

$ICON_Compose = "Создать";
$ICON_Inbox = "Входящие";
$ICON_Sent = "Ушедшие";
$ICON_Delete = "Удалить";
$ICON_Addresses = "Адреса";
$ICON_Settings = "Настройки";
$ICON_Help = "Помощь";
$ICON_Logoff = "Выход";

// Headers
// ---------------------------------------------------------
// These are message, frame, e-mail forms, and list headers.

$HEAD_Folders = "Почта";
$HEAD_To = "Кому";
$HEAD_From = "От";
$HEAD_Subject = "Тема";
$HEAD_Recieved = "Получено";
$HEAD_Sent = "Отправлено";
$HEAD_Attachment = "Вложения";
$HEAD_Name = "Имя";
$HEAD_EMail = "E-Mail";
$HEAD_Info = "Дополнительная информация";
$HEAD_Actions = "Действия";
$HEAD_DisName = "Полное имя";
$HEAD_Signature = "Шаблон подписи";
$HEAD_Error = "Ошибка:";

// Status Bar
// ------------------------------------------------------------------
// These are text displayed on the browsers status bar when the mouse
// rolls over a button or link

$STATBAR_Reply = "Ответить на это сообщение";
$STATBAR_Forward = "Переслать это сообщение";
$STATBAR_Redirect = "Перенаправить это сообщение";
$STATBAR_Headers = "Показать заголовки сообщения";
$STATBAR_Attachments = "Показать прикрепленные файлы";
$STATBAR_ComposeMessage = "Создать новое письмо";
$STATBAR_DeleteMessage = "Удалить выбранные сообщения";
$STATBAR_Inbox = "Показать входящие сообщения";
$STATBAR_Sent = "Показать ушедшие сообщения";
$STATBAR_CheckMail = "Проверить почту";
$STATBAR_AddressBook = "Адресная книга";
$STATBAR_About = "Информация о программе";
$STATBAR_SendTo = "Написать письмо на этот адрес";
$STATBAR_AddAddress = "Добавить новую запись";
$STATBAR_EditAddress = "Редактировать эту запись";
$STATBAR_DeleteAddress = "Удалить эту запись";
$STATBAR_Send = "Отправить это сообщение";
$STATBAR_Settings = "Изменить Ваши настройки";
$STATBAR_Link = "Открыть ссылку в новом окне";
$STATBAR_Logoff = "Завершить сессию";

// Error Message
// --------------------------------------------------------------
// These are error messages displayed in case of a malfunction of
// user mistake.

$ERROR_Title = "Ошибка";
$ERROR_AtLogin = "Ошибка авторизации";
$ERROR_Auth = "Пользователь не аутентифицирован.";
$ERROR_NoSession = "Сессия просрочена или не была открыта. Пройдите авторизацию.";
$ERROR_SessionErr = "Ошибка сессии";
$ERROR_SQLErr = "Ошибка SQL";
$ERROR_AddUser = "Невозможно добавления пользователя.";
$ERROR_SQLGetData = "Невозможно получить данные.";
$ERROR_SQLConnect = "Невозможно установить соединение с SQL сервером.";
$ERROR_SQLSave = "Невозможно сохранить данные.";
$ERROR_SQLUpdate = "Невозможно обновить данные.";
$ERROR_SQLDelete = "Невозможно удалить данные.";
$ERROR_FileTooBig = "Файл, который Вы пытаетесь отправить имеет слишком большой размер для этой почтовой системы.";
$ERROR_NoFile = "Файл, который Вы пытаетесь отправить не был принят почтовым сервером.";
$ERROR_NoEMail = "Вы должны указать адрес получателя.";
$ERROR_NoMessage = "Вы должны заполнить сообщение для отправки.";
$ERROR_EmailChars = "Адрес получателя содержит недопустимые символы:";
$ERROR_EmailStruct = "Адрес получателя выглядит некорректно:";
$ERROR_Send = "Невозможно отправить сообщение. Попробуйте отправить позже.";

// Misc
// -------------------------------
// Other sets of important labels.

$MISC_SideNote = "ПРИМЕЧАНИЕ";
$MISC_AddressBook = "Взять из адресной книги";
$MISC_NoMessage = "Нет новых сообщений.";
$MISC_Sent = "Ваше сообщение было успешно отправлено.";
$MISC_BackToMsg = "Возвратиться к сообщению";
$MISC_Entries = "Число записей";
$MISC_AskDelete = "Вы уверены, что хотите удалить выбранные сообщения?";
$MISC_Contact_AskDelete = "Вы уверены, что хотите удалить эту запись?";
$MISC_Select = "Нет выбранных сообщений!";
$MISC_NoEmail = "Пожалуйста введите E-mail адрес.";
$MISC_Settings = "Настройки сохранены.";
$MISC_Quote = "---- Оригинальное сообщение ----";

// Help Items
// -------------------------------

$HELP_Item[0] = 'Об этой программе';
$HELP_Text[0] = 'Этот почтовый веб-клиент разработан программистами: Alexander Djourik <a href="mailto:adju@iszf.irk.ru">adju@iszf.irk.ru</a>, Pavel Zhilin <a href="mailto:pzh@iszf.irk.ru">pzh@iszf.irk.ru</a> и Anton Gorbunov <a href="mailto:anton@iszf.irk.ru">anton@iszf.irk.ru</a>. W3mail проект основан на коде и идеях почтового веб-клиента 6XMail разработанного  6XGate Systems, Inc. Эта программа работает под управлением PHP 5. Иконки были заимствованы из различных программ. Дополнительную информацию Вы можете получить на странице проекта <a target="_blank" href="http://w3mail.sourceforge.net">w3mail.sourceforge.net</a>';

$HELP_Item[1] = 'Проверка новой почты и обновление списка сообщений';
$HELP_Text[1] = 'Вы можете просмотреть входящие сообщения или проверить наличие новых сообщений нажав на иконке <b>Входящие</b> в <b>Списке папок</b>.';

$HELP_Item[2] = 'Просмотр сообщения';
$HELP_Text[2] = 'Просто нажмите на заголовок сообщения, которое Вы желаете посмотреть в <b>Списке сообщений</b>.';

$HELP_Item[3] = 'Просмотр и загрузка присоединенных файлов';
$HELP_Text[3] = 'Нажмите на заголовок сообщения, от которого Вы желаете получить вложение, в <b>Списке сообщений</b>. Когда сообщение появится, нажмите на кнопку <b>Вложения</b>. Тогда список вложений появится в области сообщения. Просто нажмите на вложение, которое Вы желаете загрузить.';

$HELP_Item[4] = 'Ответ на сообщение';
$HELP_Text[4] = 'Нажмите на заголовок сообщения, на которое Вы желаете ответить, в <b>Списке сообщений</b>. Когда сообщение появляется, затем нажмите на кнопке <b>Ответить</b>. Когда появится форма сообщения для его редактирования, поля <b>Кому: </b> и <b> Тема: </b> будут заполнены автоматически. Просто нажмите в область тела сообщения и напечатайте ответ перед оригинальным сообщением.';

$HELP_Item[5] = 'Пересылка сообщения';
$HELP_Text[5] = 'Нажмите на заголовок сообщения, которое Вы желаете переслать, в <b>Списке сообщений</b>. Когда сообщение появится,  нажмите на кнопку <b>Переслать</b>. Когда появится форма сообщения для его редактирования, поле <b>Тема:</b> будет заполнено автоматически. Заполните поле <b>Кому:</b>, нажмите в область тела сообщения и напечатайте ответ перед оригинальным сообщением.';

$HELP_Item[6] = 'Перенаправление сообщения';
$HELP_Text[6] = 'Нажмите на заголовок сообщения, которое Вы желаете перенаправить, в <b>Списке сообщений</b>. Когда сообщение появится,  нажмите <b>Перенаправить<b> и заполните поле получателя сообщения.';

$HELP_Item[7] = 'Удаление сообщения';
$HELP_Text[7] = 'Нажмите на заголовок сообщения, которое Вы желаете удалить, в <b>Списке сообщений</b>. Когда сообщение появится, нажмите на иконку <b>Удалить</b> в <b>Списке папок</b>.';

$HELP_Item[8] = 'Просмотр RFC-822 заголовков сообщения';
$HELP_Text[8] = 'Нажмите на заголовок сообщения, RFC-822 заголовки которого Вы желаете просмотреть, в <b>Списке сообщений</b>. Когда сообщение появится,  нажмите <b>Заголовки</b>. Заголовки RFC-822 сообщения будут показаны в области тела сообщения.';

$HELP_Item[9] = 'Выход';
$HELP_Text[9] = 'Вы можете выйти из почтовой системы нажав иконку <b>Выход</b> в <b>Списке папок</b>.';
?>
