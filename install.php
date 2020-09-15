<?PHP
/*********************?><pre>
Если Вы видите эти строки, то это значит,
что на вашем сервере не установлена поддержка PHP5.
Пожалуйста, обратитесь к системному администратору
или в службу поддержки хостинг-провайдера.
</pre>******************/
//<!--
if (empty($_REQUEST['image'])) {
@session_start ();
set_time_limit(0);
//error_reporting (E_ALL);
error_reporting (0);
header ('Content-Type: text/html; charset=utf8');

define ('DEFAULT_FILE_RIGHTS', '0644');   // 0644
define ('DEFAULT_DIR_RIGHTS', '0755');    // 0755
define ('ASK_EMAIL', false); 

$lang_ru = '
installation_title = Установка программы<delimeter>
installation_php_test = Проверка наличия языка PHP и поддержки файлов с расширением &quot;.phtml&quot;<delimeter>
installation_base_params = ШАГ 1. Указание общих параметров и параметров подключения к базе данных MySQL<delimeter>
installation_unavailable = Установка невозможна<delimeter>
installation_unavailable_step5 = Установка не произведена<delimeter>
installation_unavailable_text = Ваш хостинг или сервер не поддержкивают язык PHP или расширения файлов ".phtml". Пожалуйста, обратитесь к системному администратору или в службу поддержки хостинг-провайдера.<delimeter>
installation_language_ru = RUSSIAN<delimeter>
installation_language_en = ENGLISH<delimeter>
installation_language_de = DEUTSCH<delimeter>
installation_prog_info = Информация об установленной программе<delimeter>
installation_error_installed = Программа уже установлена на вашем сервере и повторная установка невозможна без предварительного удаления установленной системы. Пожалуйста, обратитесь к соответствующему разделу "Руководства Администратора".<delimeter>
installation_all_req = Все поля обязательны к заполнению!<delimeter>
installation_base_title = Общие параметры<delimeter>
installation_param_title = Параметр<delimeter>
installation_input_title = Значение<delimeter>
installation_main_host = Имя web-сервера, на который устанавливается программа (например www.мой-сайт.com, без указания "http://"<delimeter>
installation_mail_from = Электронный адрес, который будет указан в качестве отправителя писем от имени программы<delimeter>
installation_admin_email = Электронный адрес администратора программы (обычно это ваш E-mail)<delimeter>
installation_mailer_type = Тип почтовой системы, используемой при отправке писем<delimeter>
installation_mailer_type_smtp = SMTP<delimeter>
installation_mailer_type_sendmail = sendmail<delimeter>
installation_mailer_type_mail = mail<delimeter>
installation_mailer_smtp_host = Имя SMTP-сервера, через который будут отправляться письма (IP-адрес или www-адрес без "http://")<delimeter>
installation_mailer_smtp_port = Номер порта на SMTP-сервере (обычно 25)<delimeter>
installation_db_title = Параметры базы данных<delimeter>
installation_bd_server = Имя сервера базы данных (можно использовать нестандартный порт, например: localhost:3306)<delimeter>
installation_db_user = Пользователь базы данных<delimeter>
installation_db_pass = Пароль<delimeter>
installation_db_name = Имя базы данных<delimeter>
installation_intro_step_f = Если база данных MySQL уже создана, укажите ее параметры. Если базы данных еще не существует, вам предварительно необходимо создать её, присвоив ей любое имя. Если вы не знаете, как создать базу данных MySQL на вашем хостинг-сервере, пожалуйста, обратитесь к системному администратору или в службу поддержки хостинг-провайдера.<delimeter>
installation_but_next = ПРОДОЛЖИТЬ &gt;&gt;<delimeter>
installation_no_rights_f = Нет прав на запись в каталог <b><delimeter>
installation_no_rights_s = </b>. Пожалуйста, обратитесь к системному администратору или в службу поддержки хостинг-провайдера.<delimeter>
installation_testing = ШАГ 2. Тестирование необходимых параметров<delimeter>
installation_soft = Компонент<delimeter>
installation_need_title = Требуемое значение<delimeter>
installation_cur_title = Значение на&nbsp;сервере<delimeter>
installation_res_title = Результат<delimeter>
installation_php_title = PHP<delimeter>
installation_php_ver = версия PHP<delimeter>
installation_res_success = УСПЕШНО<delimeter>
installation_res_unsuccess = НЕУСПЕШНО<delimeter>
installation_mysql_lib_title = библиотека php.mysql<delimeter>
installation_mysqli_lib_title = библиотека php.mysqli<delimeter>
installation_short_tag_title = short_open_tag (php.ini)<delimeter>
installation_extension_dir = extension_dir<delimeter>
installation_mysql_dll = mysql.dll<delimeter>
installation_mysqli_dll = mysqli.dll<delimeter>
installation_libmysql_dll = libmysql.dll<delimeter>
installation_php5 = php5ts.dll, php5ts.lib<delimeter>
installation_mysql_block_title = MySQL<delimeter>
installation_mysql_conn = подключение к серверу<delimeter>
installation_mysql_fail_text = <br>Невозможно установить соединение с базой данный с указанными параметрами.<br>Сообщение MySQL<delimeter>
installation_mysql_ver = версия MySQL<delimeter>
installation_mysql_acc = доступ к базе данных<delimeter>
installation_hdd_title = Жесткий<BR>диск<delimeter>
installation_hdd_free = свободное место<delimeter>
installation_dir = папка для установки<delimeter>
installation_dir_not_exists = Указанной папки на сервере не существует {dir}<delimeter>
installation_dir_exists = Указанная папка существует {dir}<delimeter>
installation_hdd_sp = Мб<delimeter>
installation_write_title = права записи в папку<delimeter>
installation_crons = cron-<BR>скрипты<delimeter>
installation_is_crons = возможность установки cron-скриптов<delimeter>
installation_is_crons_text = Проверить невозможно - вы должны самостоятельно убедиться, что ваш хостинг-сервер позволяет устанавливать cron-скрипты. Обратитесь к системному администратору или в службу поддержки хостинг-провайдера, или посмотрите в тарифном плане хостинг-провайдера возможность установки cron-скриптов. Без cron-скриптов установка программы возможна, но вы не будете получать почтовые уведомления (данную настройку вы впоследствии сможете исправить).<delimeter>
installation_unavailable_text_s = Один или несколько параметров хостинг-сервера не соответствуют требованиям программы. Если устранить несоответствие не удается, пожалуйста, обратитесь к системному администратору или в службу поддержки хостинг-провайдера.<delimeter>
installation_unavailable_text_nogo = Обнаруженные несоответствия<delimeter>
installation_un_desc_f = web-сервер <b><delimeter>
installation_un_desc_s = </b> обнаружить не удалось.<delimeter>
installation_un_desc_t = SMTP-сервер<b><delimeter>
installation_un_desc_fo = </b>по порту<b><delimeter>
installation_un_desc_fi = </b>обнаружить не удалось.<delimeter>
installation_but_back = &lt;&lt; НАЗАД<delimeter>
installation_license_in = ШАГ 3. Ввод лицензионного ключа<delimeter>
installation_license_error = Ошибка!<delimeter>
installation_license_error_desc = Вы ввели неправильный лицензионный ключ. Пожалуйста, проверьте правильность ввода (отсутствие пробелов, язык ввода символов и т.п.). Если ошибка повторяется, обратитесь в службу поддержки производителя программы.<delimeter>
installation_license_intro = Лицензионный ключ предоставляется продавцом, вместе с дистрибутивом программы.<delimeter>
installation_reults_res_title = Результат<delimeter>
installation_reults_cop = Копирование файлов<delimeter>
installation_results_musql = Сохранение конфигурации базы данных MySQL<delimeter>
installation_results_rights = Установка прав на файлы<delimeter>
installation_results_lic = Запись лицензии<delimeter>
installation_results_mysql_feel = Заполнение базы данных MySQL<delimeter>
installation_results_conf = Запись конфигурации<delimeter>
installation_results_un_text = Пожалуйста, обратитесь к системному администратору или в службу поддержки хостинг-провайдера. При заполнении базы данных были обнаружены следующие ошибки:<delimeter>
installation_results_un_text_rights = Невозможно установить права на файлы. Проверьте права на запись в каталог.<br><delimeter>
installation_results_un_text_data = Не найден файл с данными.<delimeter>
installation_results_un_text_conf = Невозможно получить доступ к конфигурационным файлам.<delimeter>
installation_results_suc_title = Установка успешно завершена<delimeter>
installation_results_suc_text_s = Не забудьте сразу же после установки вручную установить cron-скрипты! Перечень cron-скриптов смотрите в документе "Руководство администратора". Если вы не знаете, как это сделать, обратитесь к системному администратору или в службу поддержки хостинг-провайдера<delimeter>
installation_results_passch_text = После первого входа в программу в целях безопасности не забудьте поменять пароль!<delimeter>
installation_enter_hd = ВОЙТИ В ПРОГРАММУ &gt;&gt;<delimeter>
installation_php_reg_gl = register_globals (php.ini)<delimeter>
installation_php_ses_hand = session.save_handler (php.ini)<delimeter>
installation_php_ses_cook = session.use_cookies (php.ini)<delimeter>
installation_php_ses_aut = session.auto_start (php.ini)<delimeter>
installation_php_file_up = file_uploads (php.ini)<delimeter>
installation_reults_op_title = Операция<delimeter>
installation_results_ac_code = Обязательно запишите запрос на активацию, он потребуется для того чтобы активировать программу и начать с ней работу. Шаги по активации программы будут вам предложены при первом старте программы.<delimeter>
installation_php_conf_file = Параметры файла конфигурации <b>php.ini</b><delimeter>
installation_results_code_text = Запрос на активацию<delimeter>
installation_results_pass_text = Логин для входа<delimeter>
installation_results_login_text = Пароль для первого входа<delimeter>
installation_license_is_trial = Установить временную версию на 10 дней (Trial-версия)<delimeter>
installation_results_copy_buff = Копировать<delimeter>
installation_agree_deny = Установка невозможна<delimeter>
installation_agree_yes = Я принимаю условия лицензионного соглашения<delimeter>
installation_agree_no = Я отвергаю условия лицензионного соглашения<delimeter>
installation_agreement = Лицензионное соглашение<delimeter>
installation_license_manager = Настоящее Лицензионное соглашение, далее по тексту – «Соглашение», заключается между Пользователем с одной стороны и Обществом с ограниченной ответственностью «ТриДаВинчи», далее по тексту «Правообладатель», с другой стороны относительно сопровождаемого данным лицензионным соглашением программного продукта «Консильери CRM», включая любые носители данных, любые печатные материалы, а также любую «встроенную» или «электронную» документацию (далее «ПО»). ПО включает также любые обновления, веб-службы, дополнительные программные средства и/или дополнения, которые могут быть предоставлены или доступны со стороны Правообладателя после приобретения исходной копии программы и только в том случае, если такие дополнения не сопровождаются отдельным лицензионным соглашением или условиями использования.<BR><BR>ПО состоит из серверной части (далее по тесту «Серверная часть») и клиентского приложения (далее по тексту «Клиентская программа»), а также из отдельных компонентов ПО (обновления, сервис паки и тп), права на которые предоставляются по отдельности, в объеме согласно п. 1.3 Соглашения.<BR><BR>Настоящее лицензионное соглашение передается Пользователю в составе с материальным носителем, на котором выражено ПО (экземпляр ПО). Пользователь, вскрывая упаковку или иным образом открывая экземпляр ПО, а также устанавливая, копируя, загружая, осуществляя доступ или иным образом используя ПО, тем самым принимаете на себя условия настоящего лицензионного соглашения.<BR><BR>1. Предмет Соглашения<BR><BR>1.1. Правообладатель предоставляет Пользователю неисключительные права на использование ПО в форме воспроизведения (записи ПО в память ЭВМ) в объеме, определенном п. 1.3 настоящего Соглашения (право воспроизведения), и сообщения ПО в интерактивном режиме на веб-сайте Пользователя согласно п. 1.3 настоящего Соглашения (право на сообщение в интерактивном режиме).<BR><BR>1.2. Для целей настоящего Соглашения Пользователь получает неисключительное право использования ПО, которое охватывает совершение действий, связанных с функционированием ПО в соответствии с его назначением согласно п. 1.1. настоящего Соглашения и объемом использования согласно п. 1.3. настоящего Соглашения, без ограничения срока и территории использования.<BR><BR>1.3. Пользователю предоставляется право однократного воспроизведения (записи в память ЭВМ) «Серверной части» ПО. Объем использования ПО в части воспроизведения (записи в память ЭВМ) «Клиентской программы» ПО определяется на основании документа под названием «Лицензионный ключ». Настоящее лицензионное соглашение передается Пользователю в составе с документом «Лицензионный ключ», упакованным вместе с экземпляром ПО, где указаны следующие параметры ПО:<BR><BR>* Код Правообладателя ПО;<BR><BR>* Название ПО и/или отдельных его компонентов;<BR><BR>* Ограничение объема использования (количество экземпляров). Под «экземпляром» понимается пользователь (сотрудник) Пользователя, пользующийся «Клиентской программой». Количество пользователей при сообщении ПО в интерактивном режиме согласно пункту 1.5 настоящего Соглашения не ограничивается;<BR><BR>* Срок действия права на использование;<BR><BR>* Регистрационный номер («Лицензионный ключ»).<BR><BR>1.4. Пользователь по соглашению c Правообладателем вправе изменить (увеличить) объем использования ПО. Объем использования считается измененным после уплаты соответствующего вознаграждения Правообладателю или иному уполномоченному им лицу по установленным тарифам за соответствующий объем использования ПО и выдачи Пользователю соответствующего регистрационного номера ПО.<BR><BR>1.5. ПО может использоваться исключительно внутри одного веб-сайта Пользователя, где сайтом считается Интернет-проект, доступный по одному доменному имени. Допускается использование ПО для проектов, доступных по нескольким доменным именам только в том случае, если одно доменное имя является основным, а остальные доменные имена – его псевдонимы.<BR><BR>2. Права на ПО<BR><BR>2.1. Все исключительные авторские (имущественные) права на ПО, его обновленные версии и компоненты принадлежат Правообладателю, в том числе, полное авторское право со всеми полномочиями на воспроизведение, модификацию, распространение и иное использование ПО, на предоставление прав пользования ПО, а также все иные интеллектуальные права, прямо или косвенно связанные с ПО.<BR><BR>2.2. Правообладатель гарантирует, что он является добросовестным владельцем исключительных авторских (имущественных) прав на ПО и не имеет каких-либо юридических ограничений для заключения настоящего Соглашения.<BR><BR>2.3. Пользователь имеет право использовать ПО только в объеме и способами, определенными в настоящем Соглашении. Если иное не предусмотрено Соглашением или законом, запрещается любое копирование ПО или распространение его без особого разрешения Правообладателя, а также разработка аналогичного программного обеспечения с использованием ПО в качестве образца.<BR><BR>3. Права и обязанности сторон<BR><BR>3.1. Правообладатель обязуется при приобретении Пользователем прав на использование обновленных версии ПО (п. 1.3) оказывать Пользователю следующие услуги:<BR><BR>3.1.1. Предоставлять Пользователю возможности регистрироваться на веб-сайте Правообладателя в разделе технической поддержки и участвовать в специальных тематических форумах о корректировке приоритетов в разработке новых модулей для будущих версий ПО.<BR><BR>3.1.2. Предоставлять возможность загрузить с сайта Правообладателя обновления версии ПО, изменения к модулям и примеры реализации тех или иных интерфейсов к ПО. При этом полученный в качестве обновления программный продукт разрешается использовать только в соответствии с условиями настоящего лицензионного соглашения.<BR><BR>3.2. Пользователь обязуется:<BR><BR>3.2.1. Своевременно и в полном объеме оплачивать право пользования ПО.<BR><BR>3.2.2. Использовать ПО исключительно в соответствии с его целевым назначением и объемом. Не использовать ПО в рамках настоящего Соглашения для обслуживания более чем одного веб-сайта.<BR><BR>3.2.3. Не производить и не допускать копирование либо модификацию ПО без письменного разрешения Правообладателя.<BR><BR>4. Цена соглашения<BR><BR>4.1. Общий размер вознаграждения Правообладателя за передачу Пользователю неисключительных имущественных прав на использование ПО (далее - Стоимость неисключительных прав) определяются стоимостью, зафиксированной в договорах, товарных накладных, актах, или иных нормативных и бухгалтерских документах, заключаемых Пользователем с Правообладателем или иным уполномоченным им лицом, которое приобрело в собственность правомерно выпущенный Правообладателем экземпляр ПО. Вознаграждение Правообладателя за передачу права на воспроизведение ПО (записи ПО в память ЭВМ) и права на сообщение ПО в интерактивном режиме на веб-сайте Пользователя определяются соответственно как 60% и 40% Стоимости неисключительных прав.<BR><BR>5. Ограниченная гарантия<BR><BR>5.1. Пользователь осведомлен о важнейших функциональных свойствах ПО и он один несет риск несоответствия ПО своим желаниям и потребностям. При наличии вопросов, Пользователь перед заключением Соглашения должен обратиться за соответствующими консультациями к сотрудникам Правообладателя или к компетентным третьим лицам.<BR><BR>5.2. Настоящая гарантия является единственной, предоставляемой Пользователю.<BR><BR>6. Ответственность Сторон<BR><BR>6.1. В случае нарушения Пользователем своих обязанностей, установленных в разделе 3.2. Соглашения, а также нарушения авторских (имущественных) прав Правообладателя и\или Авторов ПО, Правообладатель вправе:<BR><BR>6.1.1. Отказаться от настоящего Соглашения и досрочно полностью или частично лишить Пользователя прав на ПО;<BR><BR>6.1.2. Приостановить обновление ПО (п. 3.1.2) в случае, если такое право предоставлено Пользователю, на период до устранения допущенных нарушений, например, путем отказа в предоставлении новых версий ПО.<BR><BR>6.2. ПО предоставляются Пользователю «КАК ЕСТЬ» («AS IS»), в соответствии с общепринятым в международной практике принципом. Это означает, что за проблемы, возникающие в процессе установки, обновления, поддержки и эксплуатации ПО (в том числе: проблемы совместимости с другими программными продуктами (пакетами, драйверами и др), проблемы, возникающие из-за неоднозначного толкования сопроводительной документации и т.п.), Правообладатель ответственности не несет.<BR><BR>6.3. Независимо от причин и характера причиненных Пользователю убытков, максимальный размер ответственности Правообладателя по настоящему Соглашению не может превысить суммы эквивалентной 10 долларов США.<BR><BR>6.4. Правообладатель несет ответственность только за виновное нарушение своих обязательств по настоящему Соглашению.<BR><BR>6.5. Все споры и разногласия, которые могут возникнуть между Сторонами по вопросам, не нашедшим своего разрешения в тексте данного Соглашения, будут разрешаться путем переговоров на основе действующего законодательства и обычаев делового оборота. При недостижении согласия в процессе переговоров, споры разрешаются в Арбитражном суде г. Москвы при условии обязательного соблюдения претензионного порядка досудебного урегулирования.<BR><BR>6.6. Во всем остальном, что не предусмотрено настоящим Соглашением, Стороны руководствуются действующим законодательством.<BR><BR>7. Реквизиты правообладателя<BR><BR>Общество с ограниченной ответственностью «ТриДаВинчи» (ООО «ТриДаВинчи»); Юридический адрес: Россия, 394036, г.Воронеж, ул.Студенческая д.17, офис 61; ОГРН:1083668000547; ИНН:3666150357; КПП:366601001; ОКВД:72.20; ОКПО:83634274; Расчетный счет:40702810902510008825, Банк: Филиал №3652 ВТБ24(ЗАО) г.Воронеж; БИК:042007738; Кор. счет:30101810100000000738.<delimeter>
please_change_rights = Прямо сейчас смените права доступа (установите права "0755") на директорию<BR>{dir}<delimeter>
installation_wait_process = Пожалуйста подождите несколько секунд. Происходит инсталляция файлов на вашем сервере<delimeter>
installation_permission = После установки на все файлы и папки будут установлены следующие права доступа:<delimeter>
installation_permission_files = для файлов:<delimeter>
installation_permission_dirs = для директорий:<delimeter>
';
$lang_en = '
installation_title = Installation der Konsileri CRM<delimeter>
installation_php_test = checking if PHP is available<delimeter>
installation_base_params = Step 1. Setting parameters including MySQL database connection parameters<delimeter>
installation_unavailable = Installation is not available<delimeter>
installation_unavailable_step5 = Installation was not done<delimeter>
installation_unavailable_text = Your web-hosting or server hasn\'nt support of PHP language. You can ask your system administrator to get a consultation.<delimeter>
installation_language_ru = RUSSIAN<delimeter>
installation_language_en = ENGLISH<delimeter>
installation_language_de = Installation starten<delimeter>
installation_prog_info = Information about installed program<delimeter>
installation_error_installed = Program is already installed on your computer. You should delete the previous installation and after that make new inastalling.<delimeter>
installation_all_req = All fields are required!<delimeter>
installation_base_title = Base parameters<delimeter>
installation_param_title = Parameter<delimeter>
installation_input_title = Value<delimeter>
installation_main_host = Your web-server name (for example, www.мой-сайт.com, without "http://"<delimeter>
installation_mail_from = E-mail for output mail<delimeter>
installation_admin_email = Program administrator\'s email (usually it is your E-mail)<delimeter>
installation_mailer_type = Type of your mailng system<delimeter>
installation_mailer_type_smtp = SMTP<delimeter>
installation_mailer_type_sendmail = sendmail<delimeter>
installation_mailer_type_mail = mail<delimeter>
installation_mailer_smtp_host =Your SMTP mail server (IP-address or www-address without "http://")<delimeter>
installation_mailer_smtp_port = Port number on SMTP-server (usually 25)<delimeter>
installation_db_title = Database parameters<delimeter>
installation_bd_server = Database server name (you can use non-standard port, for example: localhost:3306)<delimeter>
installation_db_user = DB User<delimeter>
installation_db_pass = Password<delimeter>
installation_db_name = DB name<delimeter>
installation_intro_step_f = If database is already created you should use its parameters. Else you have to create it (you can ask your system administrator or hosting provider support).<delimeter>
installation_but_next = Next &gt;&gt;<delimeter>
installation_no_rights_f = You have no permissions to write to the directory <b><delimeter>
installation_no_rights_s = </b>. Please, ask your system administrator or your hosting provider support.<delimeter>
installation_testing = ШАГ 2. Testing of neccessary parameters<delimeter>
installation_soft = Component<delimeter>
installation_need_title = Requiring value<delimeter>
installation_cur_title = Current&nbsp; alue<delimeter>
installation_res_title = Result<delimeter>
installation_php_title = PHP<delimeter>
installation_php_ver = PHP version<delimeter>
installation_res_success = Success<delimeter>
installation_res_unsuccess = Failed<delimeter>
installation_mysql_lib_title = php.mysql library<delimeter>
installation_mysqli_lib_title = php.mysqli library<delimeter>
installation_short_tag_title = short_open_tag (php.ini)<delimeter>
installation_extension_dir = extension_dir<delimeter>
installation_mysql_dll = mysql.dll<delimeter>
installation_mysqli_dll = mysqli.dll<delimeter>
installation_libmysql_dll = libmysql.dll<delimeter>
installation_php5 = php5ts.dll, php5ts.lib<delimeter>
installation_mysql_block_title = MySQL<delimeter>
installation_mysql_conn = Connecting to server<delimeter>
installation_mysql_fail_text = <br>It is impossible to connect to database with current parameters.<br>Message from MySQL<delimeter>
installation_mysql_ver = MySQL version<delimeter>
installation_mysql_acc = DB Access<delimeter>
installation_hdd_title = HDD<delimeter>
installation_hdd_free = free space<delimeter>
installation_dir = instalation directory<delimeter>
installation_dir_not_exists = This directory does not exist: {dir}<delimeter>
installation_dir_exists = This directory exists {dir}<delimeter>
installation_hdd_sp = MB<delimeter>
installation_write_title = Folder write permissions<delimeter>
installation_crons = cron-<BR>scripts<delimeter>
installation_is_crons = cron-scripts availability<delimeter>
installation_is_crons_text = It is impossible to check availability of cron.<delimeter>
installation_unavailable_text_s =One or more points of answered to requirements. If you can\'t escape it ask your hosting provider support.<delimeter>
installation_unavailable_text_nogo = Founded mismathings<delimeter>
installation_un_desc_f = web-server <b><delimeter>
installation_un_desc_s = </b> not found.<delimeter>
installation_un_desc_t = SMTP-server<b><delimeter>
installation_un_desc_fo = </b>by port<b><delimeter>
installation_un_desc_fi = </b>not found.<delimeter>
installation_but_back = &lt;&lt; Back<delimeter>
installation_license_in = ШАГ 3. Entering license key<delimeter>
installation_license_error = Error!<delimeter>
installation_license_error_desc = Wrong license key.<delimeter>
installation_license_intro = License key.<delimeter>
installation_reults_res_title = Result<delimeter>
installation_reults_cop = Files copying<delimeter>
installation_results_musql = Saving MySQL database configuration<delimeter>
installation_results_rights = Setting permissions to files<delimeter>
installation_results_lic = filling license<delimeter>
installation_results_mysql_feel = Filling MySQL database<delimeter>
installation_results_conf = Creating configuration<delimeter>
installation_results_un_text = Ask yur system administrator, you have some errors with filling your database:<delimeter>
installation_results_un_text_rights = It is impossible to set permissions to file. Please, check read and write permissions to it.<br><delimeter>
installation_results_un_text_data = Data file not found.<delimeter>
installation_results_un_text_conf = It is impossible to get access to configuration  files.<delimeter>
installation_results_suc_title = Installation  successfully done<delimeter>
installation_results_suc_text_s = Не забудьте сразу же после установки вручную установить cron-скрипты! Перечень cron-скриптов смотрите в документе "Руководство администратора". Если вы не знаете, как это сделать, обратитесь к системному администратору или в службу поддержки хостинг-провайдера<delimeter>
installation_results_passch_text = You should change your administrator\'s password in security reasons!<delimeter>
installation_enter_hd = Enter the program  &gt;&gt;<delimeter>
installation_php_reg_gl = register_globals (php.ini)<delimeter>
installation_php_ses_hand = session.save_handler (php.ini)<delimeter>
installation_php_ses_cook = session.use_cookies (php.ini)<delimeter>
installation_php_ses_aut = session.auto_start (php.ini)<delimeter>
installation_php_file_up = file_uploads (php.ini)<delimeter>
installation_reults_op_title = Operation<delimeter>
installation_results_ac_code = You should write this code for a future, it is code for activating your program.<delimeter>
installation_php_conf_file = Configuration file parameters <b>php.ini</b><delimeter>
installation_results_code_text = Activation request<delimeter>
installation_results_pass_text = Username for fiest login<delimeter>
installation_results_login_text = Your password for first login<delimeter>
installation_license_is_trial = Install trial version for 10 days<delimeter>
installation_results_copy_buff = Copy <delimeter>
installation_agree_deny = Installation is not available<delimeter>
installation_agree_yes = I accept all the terms of License Agreement<delimeter>
installation_agree_no = I do not accept terms of License Agreement<delimeter>
installation_agreement = License Agreement<delimeter>
installation_license_manager = License Agreement<delimeter>
please_change_rights = Please change permissions ("0755") to installation directory: <BR>{dir}<BR> right now.<delimeter>
installation_wait_process = Please wait a few seconds while program being installed on your computer<delimeter>
installation_permission = После установки на все файлы и папки будут установлены следующие права доступа:<delimeter>
installation_permission_files = для файлов:<delimeter>
installation_permission_dirs = для директорий:<delimeter>
';

$lang_de = '
installation_title = Installation der Konsileri CRM<delimeter>
installation_php_test = Prüfung der Unterstützungsmöglichkeit von PHP-Sprache und Dateityp &quot;.phtml&quot;<delimeter>
installation_base_params = 1. Schritt. Eingabe von Haupteinstellungen und Einstellungen zu Verbindung mit der MySQL-Datenbank<delimeter>
installation_unavailable = Installation ist nicht möglich<delimeter>
installation_unavailable_step5 = Installation wurde nicht durchgeführt<delimeter>
installation_unavailable_text = Ihr Webhosting oder Webserver untertützt keine PHP-Sprache oder Dateityp ".phtml". Wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings.<delimeter>
installation_language_ru = RUSSIAN<delimeter>
installation_language_en = ENGLISH<delimeter>
installation_language_de = Installation starten<delimeter>
installation_prog_info = Information über installiertes Programm<delimeter>
installation_error_installed = Das Programm existiert bereits auf Ihrem Server. Eine neue Installation ist erst nach dem Deinstallieren des existierenden Programms möglich. Hilfe finden Sie in der Bedienanleitung.<delimeter>
installation_all_req = Alle Felder sind auszufühlen!<delimeter>
installation_base_title = Haupteinstellungen<delimeter>
installation_param_title = Einstellung<delimeter>
installation_input_title = Wert<delimeter>
installation_main_host = Name des Webservers, auf dem das Programm installiert wird (z.B. www.website.de, ohne Angabe von "http://"<delimeter>
installation_mail_from = E-Mail-Adresse die bei Versenden durch das Programm als Versender angezeigt werden soll.<delimeter>
installation_admin_email = E-Mail-Adresse des Programmadministrators (meist ist es Ihre eigene E-Mail-Adresse)<delimeter>
installation_mailer_type = Typ des Mail-Systems, das beim Versenden von E-Mails verwendet wird<delimeter>
installation_mailer_type_smtp = SMTP<delimeter>
installation_mailer_type_sendmail = sendmail<delimeter>
installation_mailer_type_mail = mail<delimeter>
installation_mailer_smtp_host = Name des SMTP-Servers, von welchem die E-Mails versendet werden (IP-Adresse oder WWW-Adresse ohne "http://")<delimeter>
installation_mailer_smtp_port = Die Portnummer auf dem SMTP-Server (meist 25)<delimeter>
installation_db_title = Datenbankeinstellungen<delimeter>
installation_bd_server = Name des Datenbankservers (es ist möglich, einen nicht regulären Port zunutzen, z.B. localhost:3306)<delimeter>
installation_db_user = Nutzer der Datenbank<delimeter>
installation_db_pass = Passwort<delimeter>
installation_db_name = Name der Datenbank<delimeter>
installation_intro_step_f = Fall die MySQL-Datenbank bereits existiert, geben Sie ihre Einstellungen an. Anderenfalls soll die Datenbank mit einem beliebigen Namen erstellt werden. Falls Sie dabei Hilfe benötigen, wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings.<delimeter>
installation_but_next = WEITER &gt;&gt;<delimeter>
installation_no_rights_f = Sie haben keine Berechtigung Änderungen im Ordner vorzunehmen<b><delimeter>
installation_no_rights_s = </b>. Wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings.<delimeter>
installation_testing = 2. Schritt. Überprüfen von Einstellungen.<delimeter>
installation_soft = Einstellung<delimeter>
installation_need_title = Der nötige Wert<delimeter>
installation_cur_title = Wert auf dem&nbsp;Server<delimeter>
installation_res_title = Ergebnis<delimeter>
installation_php_title = PHP<delimeter>
installation_php_ver = PHP-Version<delimeter>
installation_res_success = Erfolgreich<delimeter>
installation_res_unsuccess = Fehlgeschlagen<delimeter>
installation_mysql_lib_title = Bibliothek php.mysql<delimeter>
installation_mysqli_lib_title = Bibliothek php.mysqli<delimeter>
installation_short_tag_title = short_open_tag (php.ini)<delimeter>
installation_extension_dir = extension_dir<delimeter>
installation_mysql_dll = mysql.dll<delimeter>
installation_mysqli_dll = mysqli.dll<delimeter>
installation_libmysql_dll = libmysql.dll<delimeter>
installation_php5 = php5ts.dll, php5ts.lib<delimeter>
installation_mysql_block_title = MySQL<delimeter>
installation_mysql_conn = Verbindung mit dem Server<delimeter>
installation_mysql_fail_text = <br>Die Verbindung mit der Datenbank mit den eingegebenen Einstellungen ist nicht möglich.<br>Meldung von MySQL-Datenbank<delimeter>
installation_mysql_ver = MySQL-Version<delimeter>
installation_mysql_acc = Zugang zur Datenbank<delimeter>
installation_hdd_title = Festplatte<delimeter>
installation_hdd_free = Freier Speicher<delimeter>
installation_dir = Zielordner<delimeter>
installation_dir_not_exists = Der bestimmte Zielordner existiert nicht {dir}<delimeter>
installation_dir_exists = Der bestimmte Zielordner existiert {dir}<delimeter>
installation_hdd_sp = MB<delimeter>
installation_write_title = Zugriffsberechtigungen für den Ordner<delimeter>
installation_crons = cron-<BR>Skripts<delimeter>
installation_is_crons = Möglichkeit der Einrichtung von cron-Skrips<delimeter>
installation_is_crons_text = Überprüfung fehlgeschlagen. Prüfen Sie bitte, ob die Einrichtung von cron-Skrips auf Ihrem Server möglich ist. Wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings oder vergewissern Sie sich, ob der Tarifplan Ihres Webhostings diese Einrichtung beinhaltet. Programminstallation ist auch ohne die Unterstützung von cron-Skrips möglich, aber die Funktion für automatische Benachrichtigungen per E-Mail wird ausgeschaltet (diese Funktion kann später aktiviert werden).<delimeter>
installation_unavailable_text_s = Eine oder mehrere Einstellungen des Servers entsprechen nicht den Programmanforderungen. Wenn Sie das Problem nicht selbstständig lösen können, wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings.<delimeter>
installation_unavailable_text_nogo = Aufgetretene Probleme<delimeter>
installation_un_desc_f = Web-Server <b><delimeter>
installation_un_desc_s = </b> nicht gefungen.<delimeter>
installation_un_desc_t = SMTP-Server<b><delimeter>
installation_un_desc_fo = </b>unter Port<b><delimeter>
installation_un_desc_fi = </b>nicht gefunden.<delimeter>
installation_but_back = &lt;&lt; ZURÜCK<delimeter>
installation_license_in = 3. Schritt. Eingabe von Lizenzcode<delimeter>
installation_license_error = Fehler!<delimeter>
installation_license_error_desc = Falscher Lizenzcode. Bitte überprüfen Sie die Eingabe (Leertaste, Eingabesprache, etc.). Falls der Fehler sich wiederholt, wenden Sie sich an Support-Team des Herstellers.<delimeter>
installation_license_intro = Der Lizenzcode wird beim Kauf des Programms erteilt.<delimeter>
installation_reults_res_title = Ergebnis<delimeter>
installation_reults_cop = Kopieren von Dateien<delimeter>
installation_results_musql = Speichern der Konfiguration von MySQL-Datenbank<delimeter>
installation_results_rights = Berechtigungseinstellungen für Dateien<delimeter>
installation_results_lic = Lizenzeinstellungen<delimeter>
installation_results_mysql_feel = Füllen der MySQL-Datenbank<delimeter>
installation_results_conf = Speichern von Konfiguration<delimeter>
installation_results_un_text = Wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings. Beim Füllen der Datenbank sind folgende Fehler aufgetretten:<delimeter>
installation_results_un_text_rights = Das Einstellen von Berechtigungen für Dateien ist nicht möglich. Prüfen Sie die Berechtigungen für den Ordnerzugriff.<br><delimeter>
installation_results_un_text_data = Datei nicht gefunden.<delimeter>
installation_results_un_text_conf = Kein Zugriff zu Konfigurationsdatei.<delimeter>
installation_results_suc_title = Installation erfolgreich durchgeführt.<delimeter>
installation_results_suc_text_s = Bitte direkt nach der Installation die cron-Skripts manuell einstellen! Die Liste der cron-Skripts finden Sie im "Administratorhandbuch". Bei Fragen wenden Sie sich bitte an Ihren Administrator oder den Support-Team Ihres Webhostings.<delimeter>
installation_results_passch_text = Ändern Sie Ihr Passwort zur Sicherheit nach der ersten Anmeldung!<delimeter>
installation_enter_hd = ANMELDEN &gt;&gt;<delimeter>
installation_php_reg_gl = register_globals (php.ini)<delimeter>
installation_php_ses_hand = session.save_handler (php.ini)<delimeter>
installation_php_ses_cook = session.use_cookies (php.ini)<delimeter>
installation_php_ses_aut = session.auto_start (php.ini)<delimeter>
installation_php_file_up = file_uploads (php.ini)<delimeter>
installation_reults_op_title = Aktion<delimeter>
installation_results_ac_code = Speichern Sie die "Registrierungsnummer". Die Daten benötigen Sie zur Programmaktivierung. Die Hinweise zur Programmaktivierung werden werden beim ersten Programmstart angezeigt.<delimeter>
installation_php_conf_file = Einstellungen in der Konfigurationsdatei <b>php.ini</b><delimeter>
installation_results_code_text = Registrierungsnummer<delimeter>
installation_results_pass_text = Nutzername<delimeter>
installation_results_login_text = Passwort für die erste Anmeldung<delimeter>
installation_license_is_trial = 10 Tage gültige Testversion installieren(Trialversion)<delimeter>
installation_results_copy_buff = Kopieren<delimeter>
installation_agree_deny = Bitte erkennen Sie unsere Lizenzvereinbarung vor der Installation an!<delimeter>
installation_agree_yes = Ich stimme der Lizenzvereinbarung zu<delimeter>
installation_agree_no = Ich lehne der Lizenzvereinbarung ab<delimeter>
installation_agreement = Lizenzvereinbarung<delimeter>
installation_license_manager = HINWEIS AN DEN ENDNUTZER:<BR><BR>Dies  ist ein Vertrag. Am Ende werden Sie dazu aufgefordert, dieses Übereinkommen, um das Programm installieren zu können, anzunehmen, oder die hier im Vertrag beschriebenen Vereinbarungen abzulehnen.  Im Falle der Ablehnung Ihrerseits werden Sie nicht in der Lage sein dieses Programm zu verwenden, zu installieren oder zu betreiben. Wie weiter unten definiert akzeptieren Sie alle Bedingungen dieses Vertrages indem Sie diese Software installieren.<BR><BR>Diese elektronische Endnutzerlizenzvereinbarung  (im weiteren Textverlauf "Vereinbarung" genannt) ist ein rechtsgültiger Vertrag zwischen Ihnen (entweder einer natürlichen oder juristischen Person), dem Lizenznehmer, und TriDaVinchi Ltd. und ihren Tochtergesellschaften (zusammen die "Lizenzgeber"). Im Bezug auf die Software und den Service betitelt „Konsileri CRM ™“, die Sie über den Download heruntergeladen oder auf andere Weise durch andere Mittel oder Medien wie z.B. CD-ROMs, Disketten oder ein Netzwerk in Form von Objektcode erhalten haben oder andere damit zusammenhängende Dienstleistungen, einschließlich und ohne Einschränkung a) der komplette Inhalt der Dateien, Disk(s), CD-ROM(s) oder andere Medien, mit denen dieses Abkommens (die "Software"), und b) alle Nachfolger Upgrades, Korrekturen, Patches, Erweiterungen, Reparaturen, Modifikationen, Kopien, Ergänzungen oder Maintenance-Releases der Software (zusammen die "Updates"), wenn überhaupt durch den Lizenzgeber vorgesehen, dass die Updates erfolgt ohne eine neue nachfolgenden Versionen von Konsileri CRM ™ mit einer neuen erste Ziffer wie z.B. 4,0 oder 5,0 ("New Releases"), sondern umfassen alle geringfügigen Revisionen der Konsileri CRM ™-Version angezeigt durch eine Veränderung der Zahl im Dezimalstellenbereich, wie 2.3 oder 2.4, und c) in Verbindung Benutzerdokumentation und erläuternden Materialien oder Dateien in einer schriftlichen, “online“ oder in elektronischer Form (die „Dokumentation“ und zusammen mit der Software und Updates, das „Produkt“).<BR><BR>Sie unterliegen den Bestimmungen und Bedingungen dieses Endnutzerlizenzvertrages sowohl wenn Sie den Zugriff auf das Produkt direkt vom Lizenzgeber als auch durch jede andere Quelle erhalten haben. Für die Zwecke dieser Bestimmung ist mit "Sie" oder "Lizenznehmer" eine einzelne Person gemeint, die die Installation oder die Nutzung des Produkts für ihre eigenen Zwecke und unter ihrem eigenen Namen durchführt. Sollte das Produkt heruntergeladen worden sein und wird im Namen einer Organisation installiert (z.B. ein Arbeitgeber), dann ist mit "Sie" oder "Lizenznehmer" die Organisation, für die das Produkt heruntergeladen und installiert wird, gemeint. Falls der zweite Fall eintrifft, wird hiermit auch erklärt, dass die jeweilige Organisation, um diese Vereinbarung im Namen der Organisation annehmen zu können, eine Person für die Annahme dieser Vereinbarung autorisiert haben muss.<BR><BR>Für die Zwecke dieser Bestimmungen schließt der Begriff "Organisation" ohne Einschränkungen eine Partnerschaft mit beschränkter Haftung, Aktiengesellschaft, Verein, Aktiengesellschaft, Konzern, Joint Venture, Arbeitsorganisation, nicht rechtsfähige Organisation oder staatliche Behörden mit ein.<BR><BR>Durch den Zugriff, das Herunterladen, Speichern, Laden, Installieren, Ausführen, Anzeigen und Kopieren des Produkts in den Speicher eines Computers oder durch das Profitieren auf eine andere Weise von der Funktionalität des Produkts in Übereinstimmung mit der Dokumentation ("Operating"), erklären Sie sich mit den Bedingungen dieses Abkommens einverstanden.<BR><BR>Wenn Sie mit den Bedingungen dieser Vereinbarung nicht einverstanden sind und diesen nicht zustimmen möchten, ist der Lizenzgeber nicht bereit, das Produkt an Sie zu lizenzieren. In einem solchen Fall können Sie die Software in keinster Weise bedienen oder verwenden.<BR><BR>BEVOR Sie ein Häkchen bei dem Feld "Ich bin mit den oben genannten Bedingungen einverstanden" setzen und auf "Weiter" klicken, LESEN SIE BITTE DIE BEDINGUNGEN DIESER VEREINBARUNG SORGFÄLTIG DURCH. Ihr Klicken auf das "Ich stimme zu" Feld ist ein SYMBOL IHRER SIGNATUR UND DURCH KLICKEN AUF DIE "Weiter"-Taste, stimmen Sie den Bedingungen zu und erklären sich damit einverstanden, an die Bedingungen dieser Vereinbarung gebunden zu sein und werden damit zu einem TEIL DIESER VEREINBARUNG. WENN SIE NICHT MIT ALLEN BEDINGUNGEN DIESER VEREINBARUNG EINVERSTANDEN SIND, dann klicken Sie auf die "Abbrechen"-Taste und die Software wird auf Ihrem Computer nicht installiert.<BR><BR>Dieses Produkt wird nicht auf Ihrem Computer installiert, es sei denn, Sie akzeptieren die Bedingungen dieser Vereinbarung. Sie können auch eine Kopie dieser Vereinbarung durch eine Kontaktaufnahme mit dem Lizenzgeber über info@konsileri-crm.de erhalten.<BR><BR>Für die Zwecke dieses Abkommens ist mit dem Begriff "Lizenzgeberseite" die Internet-Website des Lizenzgebers gemeint, auf der das Produkt zum Download im Rahmen einer Lizenz vom Lizenzgeber zur Verfügung gestellt wird.<BR><BR>1.	Schutzrechte und Geheimhaltungsvereinbarung<BR><BR>1.1.	Eigentumsrechte <BR><BR>Sie bestätigen, dass das Produkt und die Urheberschaft, Systeme, Ideen, Methoden der Operation, Dokumentation und andere im Produkt enthaltene Aspekte, das geistige Eigentum und/oder die wertvollen Betriebsgeheimnisse des Lizenzgebers oder seiner Zulieferer und/oder Lizenzgeber, durch das Zivil- und Strafrecht und das Urheberrecht, sowie durch die Geschäftsgeheimnisse, Marken- und Patentrecht der Vereinigten Staaten und  anderer Länder und durch internationale Verträgen geschützt sind.<BR><BR>Sie können die Marken nur insoweit nutzen, als dass Sie die gedruckte Datenausgabe des Produkts in Übereinstimmung mit der gängigen Praxis zur Benutzung des Markenzeichens, einschließlich der Identifizierung des Namens des Markeninhabers, identifizieren.<BR><BR>Eine solche Nutzung der Marke gibt Ihnen nicht die Eigentumsrechte an diesem Warenzeichen.<BR><BR>Der Lizenzgeber und/oder seine Lieferanten besitzen und behalten alle Rechte, Titel und Interessen in Bezug auf das Produkt, einschließlich und ohne Einschränkungen der Fehlerkorrekturen, Verbesserungen und Updates oder sonstigen Modifikationen an der Software, ob durch den Lizenzgeber oder einem Dritten vorgenommen, sowie auch alle Urheberrechte, Patente, Geschäftsgeheimnisse, Marken und andere geistigen Eigentumsrechte.<BR><BR>Der Besitz, die Installation und/oder die Nutzung des Produkts überträgt Ihnen keinerlei Rechte an dem geistigen Eigentum oder an der Ware und Sie erwerben auch keine Rechte, außer der ausdrücklich in dieser Vereinbarung festgelegten, an dem Produkt.<BR><BR>Alle erstellten Kopien des Produkts müssen dieselben eigentumsrechtlichen Hinweise enthalten.<BR><BR>Mit Ausnahme der zuvor in dieser Vereinbarung beschriebenen, werden Ihnen keinerlei Rechte an geistigem Eigentum oder an dem Produkt gewährt. Weiterhin bestätigen Sie, dass die Lizenz, wie bereits oben im Rahmen dieses Abkommens definiert, Ihnen nur ein Recht für den beschränkten Einsatz, unter den Bedingungen dieses Abkommen, gewährt.<BR><BR>1.2. Quellcode <BR><BR>Sie erkennen an, dass der Quellcode des Produkts Eigentum des Lizenzgebers oder seiner Zulieferer und/oder Lizenzgeber ist und Geschäftsgeheimnisse des Lizenzgebers oder seiner Zulieferer und/oder seiner Lizenzgeber darstellt.<BR><BR>Sie stimmen zu nichts zu verändern, anzupassen, zu übersetzen, zu vertauschen, zu dekompilieren, zu disassemblieren oder anderweitig zu versuchen, den Quellcode des Produkts in irgendeiner Weise zu entdecken.<BR><BR>Für die Zwecke dieser Vereinbarung ist mit dem Begriff "Quelltext" folgendes gemeint: die Computer-Programmierung Codes und zugehörige Dokumentationen einschließlich aller Kommentare und verfahrensrechtlicher Codes, die in einer für die Menschen lesbarer Form erstellt worden sind.<BR><BR>1.3. Vertrauliche Informationen<BR><BR>Sie bestätigen, dass, sofern nicht ausdrücklich erwähnt, es sich beim Produkt, einschließlich der spezifischen Gestaltung und Struktur der einzelnen Programme, die für das Produkt vorgesehen sind, um vertrauliche und firmeneigene Informationen des Lizenzgebers oder seiner Zulieferer und/oder seiner Lizenzgeber handelt.<BR><BR>Weiterhin stimmen Sie zu, nichts zu übertragen, zu kopieren, zu veröffentlichen, bereitzustellen oder anderweitig verfügbar zu machen und die zuvor beschriebenen vertraulichen Informationen in keiner Form an Dritte weitergegeben.<BR><BR>Für die Zwecke dieser Vereinbarung ist mit dem Begriff "Lizenzcode" eine einzigartige Sequenz oder eine Reihe von Sequenzen von Ziffern und/oder Symbolen oder eine Datei, gemeint, die Ihnen den Kauf der Lizenz durch den Lizenzgeber bestätigt. Diese Datei kann Informationen über die Lizenz enthalten, d.h. über seine Art, den Namen des Lizenznehmers, die Anzahl der erworbenen Lizenzen oder die Anzahl der berechtigten Nutzer, und ermöglicht damit die volle Funktionalität des Produkts in Übereinstimmung mit der Lizenz, die Ihnen im Rahmen dieses Abkommens gewährt wird.<BR><BR>Sie stimmen zu, angemessene Sicherheitsmaßnahmen zu realisieren, um so vertrauliche Informationen zu schützen. Vorausgesetzt jedoch, dass Sie möglicherweise beliebig viele Kopien der Testversion des Produkts mit dem Objekt-Code erstellen und diese Kopien vertreiben, muss der Besitzer, der von Ihnen erstellten und vertriebenen Kopie, die dieses Abkommen enthalten muss und diesem unterliegt, zustimmen. Das Annehmen dieser Endnutzerlizenzvereinbarung muss vor dem ersten Gebrauch erfolgen. Diese erstellte Kopie enthält dieselben Urheberrechts- und anderen Eigentumsrechte in Bezug auf das Produkt.<BR><BR>Wenn Sie die Software aus dem Internet oder ähnlichen Online-Quellen heruntergeladen haben, müssen Sie die Copyright-Hinweise, die sich auf die Software beziehen mit jedem Online-Vertrieb sowie auf allen Medien, die Sie verteilen, die auch die Software enthalten, miteinbeziehen. Der Begriff "Interne Nutzer" bezeichnet Mitarbeiter des Lizenznehmers, die dieses Produkt gemäß den Bestimmungen dieser Satzung verwenden.<BR><BR>Mit dem Begriff "Externe Nutzer" sind Mitarbeiter von Tochtergesellschaften des Lizenznehmers gemeint, die dem Lizenznehmer als Berater zur Seite stehen oder Kunden des Lizenznehmers sind, die das Produkt für begrenzte Zwecke verwenden dürfen. Die Nutzung für externe Nutzer muss durch den Lizenzgeber erlaubt werden, das heißt das Produkt wird für die Zuordnung von Aufgaben und Anträgen gemäß dem Vertragsinhalt benutzt.<BR><BR>1.4. Keine Änderung <BR><BR>Sie stimmen zu, das Produkt in keinster Weise zu modifizieren oder abzuändern. Sie werden von den Copyright-Vermerken oder anderen gesetzlich geschützten Bezeichnungen in keiner Kopie des Produkts etwas entfernen oder verändern.<BR><BR>2.	Erteilung der Lizenz<BR><BR>2.1.	Lizenz <BR><BR>Der Lizenzgeber genehmigt Ihnen das nicht-exklusive und nicht übertragbare Recht, die angegebene Version der Software durch eine bestimmte Anzahl von internen und externen Benutzern oder durch eine angegebene Anzahl von Servern, PCs, Workstations, PDAs, Smart Phones, Mobiltelefonen, Handheld-Geräte oder anderen elektronischen Geräten, für die die Software entwickelt wurde (jeweils ein "Client Device"), gemäß den Bestimmungen und Bedingungen dieser Vereinbarung ("Lizenz"), zu speichern, zu laden, zu installieren, auszuführen und darzustellen ("Verwendung") und Sie stimmen hiermit zu, diese Lizenz wie folgt zu akzeptieren:<BR><BR>a) Testversion<BR><BR>Wenn Sie eine Testversion des Produkts erhalten, heruntergeladen und/oder installiert haben, wird Ihnen hiermit eine Lizenz für die Software erteilt und Sie dürfen das Produkt nur für die Auswertung verwendeter Zwecke und nur während der einzig geltenden Auswertung in einem Zeitraum von dreißig (30) Tagen benutzen, die Anzahl der internen Nutzer darf nicht mehr als fünfzig (50) betragen, die Anzahl von externen Nutzern ist, sofern nicht anders angegeben, ab dem Datum der Erstinstallation nicht begrenzt.<BR><BR>Jede Verwendung des Produkts für andere Zwecke oder von einem anderen Benutzer oder über den geltenden Testzeitraum ist strengstens untersagt, vorausgesetzt jedoch, dass, vorbehaltlich der darin enthaltenen Beschränkungen, Sie die Testversion der Software ohne irgendwelche Änderungen kopieren und an Dritte im Sinne dieses Abkommens verbreiten können.<BR><BR>b) Lizenz für eine begrenzte Anzahl der Nutzer<BR><BR>Wenn das Produkt zum Zeitpunkt des Kaufs entweder auf der Lizenzgeber Website und/oder auf der Rechnung des jeweiligen Produkts oder auf der Verpackung des Produkts mit "Lizenz für eine begrenzte Anzahl der Nutzer " ausgezeichnet ist, können Sie oder jemand in Ihrem Unternehmen das Produkt auf einem einzigen Server, der im Besitz ihres Unternehmens ist, installieren, der Zugriff über eine beliebige Anzahl von anderen Smart Phones ist unabhängig vom Standort, sofern die Anzahl der internen Nutzer nicht die Anzahl der von Ihnen erworbenen Lizenzen überschreitet. <BR><BR>Darüber hinaus können die einzelnen Lizenzbedingungen zusätzliche Bedingungen und Beschränkungen enthalten.<BR><BR>с) Lizenz für eine unbegrenzte Anzahl der Nutzer<BR><BR>Wenn das Produkt zum Zeitpunkt des Kaufs entweder auf der Lizenzgeber Website und/oder auf der Rechnung des jeweiligen Produkts oder auf der Verpackung des Produkts mit "Lizenz für eine unbegrenzte Anzahl der Nutzer" ausgezeichnet ist, können Sie oder jemand in Ihrem Unternehmen das Produkt auf einem einzigen Server, der von im Besitz Ihres Unternehmens ist, installieren Der Zugriff über eine beliebige Anzahl von anderen Smart Phones ist unabhängig vom Standort, die Anzahl der internen und der externen Nutzer kann unbegrenzt sein. Darüber hinaus können die einzelnen Lizenzbedingungen zusätzliche Bedingungen und Beschränkungen enthalten.<BR><BR>d) Back-up Kopien <BR><BR>Die Lizenzgeber erlauben es Ihnen, nur soviele Backup-Kopien des Produkts zu machen, wie es für seine rechtmäßige Nutzung ausschließlich für Backup-Zwecke vonnöten ist, vorausgesetzt, dass alle diese Kopien alle Produkt-Eigentumshinweise enthalten und dass die Installation und Nutzung vom Produkt nicht über die im Abschnitt 2 beschriebenen Bedingungen hinausgeht.<BR><BR>e) Der Lizenzgeber behält sich alle Rechte, die nicht ausdrücklich eingeräumt werden. <BR><BR>2.2.	Produkte verschiedener Umgebungen, Produkte mit verschiedenen Sprachen, Dual Media Produkt, Mehrfachkopien, Bundles<BR><BR>Wenn Sie unterschiedliche Versionen des Produkts (die z.B. für verschiedene Betriebssysteme konzipiert wurden) oder verschiedene Sprachversionen des Produkts verwenden, wenn Sie das Produkt auf mehreren Medien bekommen haben, wenn Sie anderweitig mehrere Kopien des Produkts besitzen oder wenn Sie das Produkt gebündelt mit anderer Software bekommen haben, so wird die Gesamtzahl der internen und externen Benutzer des Produkts und der Anzahl der Lizenzen, der Anzahl der internen und externen Benutzer der Anzahl der Lizenzen denen entsprechen, die Sie vom Lizenzgeber erhalten haben. Sie können die Versionen oder Kopien des Produkts nicht vermieten, nicht verpachten, nicht unterlizenzieren, nicht verleihen oder übertragen, unabhängig davon ob Sie das Produkt nutzen oder nicht.<BR><BR>2.3. Updates und neue Versionen <BR><BR>Während der Laufzeit dieser Vereinbarung können Sie alle kostenlosen Updates, die vom Lizenzgeber für alle Endnutzer auf der Website des Lizenzgebers zur Verfügung gestellt werden, herunterladen. Der Download kann sowohl über die Website des Lizenzgebers als auch über andere Online-Dienste erfolgen. Sofern vom Lizenzgeber nicht als erforderlich angesehen, macht der Lizenzgeber hier von seinem Recht gebrauch, solche Updates nicht entwickeln, herstellen oder veröffentlichen zu müssen.<BR><BR>Ungeachtet dessen was von gegenteiligen Vorschriften bestimmt wird, ist nichts in dieser Vereinbarung dazu ausgelegt, Ihnen irgendwelche Rechte, Ansprüche oder Lizenzen im Zusammenhang mit anderen Updates oder neuen Versionen dieses oder eines anderen Produkts des Lizenzgebers zu überschreiben.<BR><BR>Dieses Abkommen verpflichtet den Lizenzgeber nicht dazu, Updates oder neue Releases zu veröffentlichen. Der Lizenzgeber behält sich das Recht vor, die Verfügbarkeit eines Updates oder eines neuen Releases mit zusätzlichen Zahlungen, Abonnements und/oder Support- oder mit anderen Bedingungen und Konditionen zu versehen.<BR><BR>Wenn das Produkt oder ein Teil davon ein Update einer früheren Version des Produkts ist, müssen Sie im Besitz einer gültigen Lizenz für die frühere Version sein, um das Update verwenden zu dürfen.<BR><BR>Ungeachtet der vorstehenden Aktualisierungen, wird jedes Update zu einem Teil des Produkts und die Bedingungen dieser Vereinbarung beziehen sich ebenfalls auf dieses (sofern dieses Abkommen nicht durch ein weiteres Abkommen mit einem derartigen Update oder einer modifizierten Version des Produkts ersetzt wurde).<BR><BR>2.4. Produkt als Neuerscheinung <BR><BR>Wenn diese Kopie des Produkts eine neue Version ist, wird Ihnen eine neue Lizenz zum Austausch zur Verfügung gestellt. Sie bestätigen durch Ihre Annahme dieses Abkommens und durch die Installation, den Gebrauch und Betrieb dieser Kopie des Produkts, freiwillig auf den früheren Endnutzer-Lizenzvertrag zu verzichten. Darüber hinaus werden Sie die frühere Version des Produkts nicht weiter verwenden oder an Dritte weiter geben.<BR><BR>2.5. Laufzeit und Kündigung <BR><BR>Die Laufzeit dieser Vereinbarung ("Laufzeit") beginnt entweder wenn Sie das Produkt heruntergeladen oder installiert haben (je nachdem was früher geschieht) und läuft weiter, sofern diese nicht anders aufgrund dieser Verordnung beendet wird, für die Dauer, die in dieser Lizenz festgelegt bzw. gewährt wird.<BR><BR>Der Lizenzgeber kann diese Vereinbarung kündigen, indem er dieses Abkommen für das Produkt ersetzt oder einen Ersatz und/oder eine modifizierte Version herausbringt. Es kann sich auch um eine Aktualisierung oder Neuerscheinung des Produkts handeln. Die Aktualisierung oder Neuerscheinung des Produkts oder einer solchen Ersetzung, verändert bzw. aktualisiert diese Version der Vereinbarung und Sie geben hiermit das Einverständnis zu einem solchen neuen Abkommen.<BR><BR>Diese Vereinbarung kann durch den Lizenzgeber umgehend und/oder fristlos gekündigt werden, wenn Sie eine Ihrer Verpflichtungen oder eine der Bedingungen dieser Vereinbarung nicht einhalten.<BR><BR>Unbeschadet sonstiger Rechte ist dieser Vertrag automatisch beendet, wenn Sie mit einer der Einschränkungen oder sonstigen hier beschriebenen Anforderungen nicht einverstanden sind. Bei Kündigung oder beim Auslaufen dieses Abkommens sind Sie sofort dazu verpflichtet, die Verwendung des Produkts und aller Kopien des Produkts einzustellen.<BR><BR>2.6. Keine Rechte nach der Kündigung        <BR><BR>Nach der Kündigung dieser Vereinbarung dürfen Sie das Produkt nicht mehr betreiben und auch auf keine andere Weise nutzen.<BR><BR>2.7. Materielle und allgemeine Geschäftsbedingungen<BR><BR>Sie stimmen ausdrücklich zu, dass jede der Bestimmungen und Bedingungen dieses Abschnitts 2 materiell sind und, dass die Nichteinhaltung dieser Bestimmungen und Bedingungen ausreichend Gründe für den Lizenzgeber sind, unverzüglich diese Vereinbarung zu kündigen und die Lizenz im Rahmen dieses Vertrages zu entziehen.<BR><BR>Das Vorhandensein dieses Abschnitts 2.7 ist nicht relevant für die Bestimmung der Materialität jeder anderen Bestimmung oder Verletzung dieser Vereinbarung durch irgendeine Partei.<BR><BR>3.	Einschränkungen<BR><BR>3.1.	Keine Transfers <BR><BR>Unter keinen Umständen dürfen Sie Ihre Lizenz verkaufen, verleihen, vermieten, verpachten oder Unterlizenzen veröffentlichen, darstellen, verteilen oder anderweitig übertragen, um einem Dritten das Produkt oder eine Kopie im Ganzen oder in Teilen, ohne eine vorherige schriftliche Zustimmung des Lizenzgebers, zur Verfügung zu stellen. Unter den Umständen, dass solche unverzichtbaren Rechte speziell für Sie nach geltendem Recht und in Ihrer Rechtsordnung gewährt werden können, können Sie Ihre Rechte im Rahmen dieses Abkommens auf Dauer übertragen oder an eine juristische Person weitergeben, sofern Sie<BR><BR>a) auch dieses Abkommen, mit den produktbegleitendend gedruckten Materialien und aller anderen Software oder Hardware, die eventuell auch schon vorinstalliert ist, einschließlich aller Kopien, Updates und früherer Versionen an diese natürliche oder juristische Person übertragen;<BR><BR>b) keine Kopien, einschließlich Sicherungskopien und sonstiger Kopien, auf einem Smart Phone gespeichert lassen und<BR><BR>c) die empfangende Partei die Bedingungen dieses Abkommens und alle anderen Bedingungen, unter denen Sie dieses Produkt legal erworben haben, akzeptiert. Ungeachtet des Vorstehenden dürfen Sie keine Bildung, Vorversionen oder Kopien des Produkts, die nicht zum Verkauf gedacht sind, übertragen. In keinem Fall sind Sie berechtigt, Dritten zu erlauben, aus der Nutzung oder Funktionalität des Produktes über Timesharing, Rechenzentren oder anderen Vereinbarungen zu profitieren, es sei denn diese Verwendung ist vom Lizenzgeber ausdrücklich erlaubt und/oder geht aus Ihrer Bestellung oder der Produktverpackung hervor.<BR><BR>3.2. Verbote<BR><BR>Sofern nicht ausdrücklich in diesem Abkommen angegeben, dürfen Sie das Produkt oder Teile des Produkts nicht kopieren, klonen, emulieren, vermieten, verpachten, verkaufen, modifizieren, dekompilieren, zurückentwickeln oder auf andere Art und Weise das Produkt oder Teile des Produkts in einer menschlich lesbaren Form zur Verfügung stellen. Das Übertragen des lizensierten Produkts an Dritte ist außer in dem Umfang der vorstehenden Einschränkung durch anwendbares Recht ausdrücklich verboten.<BR><BR>Ungeachtet des Vorstehenden ist Dekompilierung der Software, soweit die Gesetze es Ihnen in Ihrem Land erlauben, erlaubt, um notwendige Informationen zu bekommen um die Software kompatibel mit anderer Software zu machen, vorausgesetzt jedoch, dass Sie zuerst eine Anfrage der von Ihnen gewünschten Informationen beim Lizenzgeber machen. Der Lizenzgeber kann Ihnen nach eigenem Ermessen entweder solche Informationen zur Verfügung stellen (vorbehaltlich einer Diskretion Ihrerseits) oder zumutbare Bedingungen mit dieser Informationen, einschließlich einer angemessenen Gebühr für eine solche Nutzung der Software, verknüpfen. Die Rechte des Lizenzgebers und seiner Lieferanten und/oder seiner Lizenzgeber an der Software müssen natürlich geschützt sein und haben weiterhin Bestand.<BR><BR>Sie dürfen am Produkt nichts ändern und Sie dürfen keine abgeleiteten Arbeiten erstellen, die ganz oder teilweise auf dem Produkt basieren. Jegliche unerlaubte Benutzung führt zu einer sofortigen und automatischen Beendigung dieses Abkommens und durch die hierunter gewährte Lizenz führt es automatisch zu einer straf- und/oder zivilrechtlichen Verfolgung.<BR><BR>Weder der Binärcode noch der Quellcode des Produkts dürfen verwendet oder neu entwickelt werden, um den Programm-Algorithmus neu zu erstellen. Dieser ist proprietär und ohne schriftliche Genehmigung des Lizenzgebers umzukehren. Alle nicht ausdrücklich eingeräumten Rechte sind hier dem Lizenzgeber und/oder deren Lieferanten und seiner Lizenzgeber vorbehalten.<BR><BR>3.3. Lizenzcode <BR><BR>Es ist Ihnen nicht gestattet, Ihren registrierten Lizenzcode oder eine Kopie davon weiterzugeben, zu verkaufen oder anderweitig an Dritte zu übertragen. Der Lizenzcode des Produkts darf nicht unter anderen, als unter den hier beschriebenen Bedingungen, und ohne schriftliche Erlaubnis des Lizenzgebers verkauft werden. Der unberechtigte Verkauf führt zu einer Urheberrechtsverletzung. Der Lizenzgeber behält sich das Recht auf Ersatzansprüche für Schäden, die durch Ihre Weitergabe des Lizenzcodes oder durch das Freischalten des Codes auftreten, vor. Dieser Anspruch gilt für alle Kosten, die dem Lizenzgeber oder seinen Lizenzgebern durch den Rechtsstreit entstehen.<BR><BR>3.4. Eigentumshinweise und Kopien<BR><BR>Es ist Ihnen nicht gestattet, Urheberrechtshinweise oder Etiketten des Produkts zu entfernen oder zu verändern. Sie sind nicht berechtigt, das Produkt unter anderen als unter den in § 2 zulässigen Bedingungen zu kopieren.<BR><BR>3.5. Keine Übertragung von Rechten<BR><BR>Sofern hier nicht ausdrücklich vorausgesetzt, können Sie die Ihnen im Rahmen dieses Abkommens übertragenen Rechte oder Verpflichtungen gemäß dieser Verordnung nicht übertragen oder abtreten. Wenn Sie das Client-Gerät, auf dem das Produkt installiert ist, verkaufen, müssen Sie sicherstellen, dass alle Kopien des Produkts deinstalliert bzw. entfernt werden.<BR><BR>3.6. Zusätzliche Schutzmaßnahmen<BR><BR>Ausschließlich zum Zwecke der Vermeidung unlizenzierter Verwendung des Produkts, kann die auf Ihrem Computer installierte Software technologische Maßnahmen enthalten, die eine nicht lizenzierte Nutzung verhindern sollen, und der Lizenzgeber kann diese Technologie nutzen, um eine Bestätigung zu erhalten, dass Sie eine lizenzierte Kopie des Produkts nutzen.<BR><BR>Die Aktualisierung dieser technischen Maßnahmen kann durch die Installation des Updates erfolgen. Die Updates werden nicht installiert oder die Installation kann fehlschlagen, falls Sie eine unlizenzierte Kopie des Produkts nutzen. Wenn Sie keine lizenzierte Version des Produkts verwenden, sind Sie nicht berechtigt, die Updates zu installieren. Der Lizenzgeber sammelt keine persönlichen identifizierbaren Informationen von Ihrem Computer während dieses Prozesses.<BR><BR>4.	Gewährleistung und Haftungsausschluss<BR><BR>4.1.	Beschränkte Garantie<BR><BR>Der Lizenzgeber gewährleistet, dass für die Dauer von sechzig (60) Tagen oder für die minimale Garantiezeit nach dem anwendbaren Recht die entweder aus i) dem Kauf der Lizenz, der Software oder aus  dem Erwerb von Medien (z.B. CDs ) auf denen dieses Produkt enthalten ist, hervorgeht, oder ii) an dem Datum des Lizenzcodes, der Ihnen vom Lizenzgeber bereitgestellt wird, zu erkennen ist. Es wird gewährleistet, dass das Produkt frei von Defekten in Material und Verarbeitung ist und, dass die Software im Wesentlichen in Übereinstimmung mit der Dokumentation ist und/oder den allgemein vom Lizenzgebers veröffentlichten, auf das Produkt bezogenen Spezifikationen entspricht.<BR><BR>Geringfügige Abweichungen der Leistung von der Dokumentation begründen keinen Gewährleistungsanspruch. DIESE GARANTIE BEZIEHT SICH NICHT AUF DIE DEMO UND BEWERTUNGS-Versionen, Updates, VOR-VERSIONEN, Probeversionen, auf Produktproben und nicht auf - nicht zum Verkauf bestimmte - Versionen (NFV) und nicht auf KOPIEN DES PRODUKTS. Um einen Gewährleistungsanspruch geltend zu machen, müssen Sie die Software dem Verkäufer zurückgeben, bei dem Sie das Produkt erhalten haben. Die Zurückgabe muss zusammen mit dem Kaufbeleg und innerhalb von sechzig (60) Tagen ab dem Erhalt des Lizenzcodes erfolgen.<BR><BR>DIE GARANTIE IN DIESEM ABSCHNITT ÜBERTRÄGT IHNEN BESTIMMTE RECHTE. SIE KÖNNEN WEITERE RECHTE, die von Gerichtsbarkeit zu Gerichtsbarkeit variieren, einschließlich und ohne Einschränkung der sogenannten Kundenrechte, die in der Europäischen Union gelten, geltend machen und den Kauf des Produkts widerrufen und vom Vertrag innerhalb von sieben Werktagen nach Eingang der Ware zurücktreten. Dies gilt nicht falls das Produkt (die Software) heruntergeladen wurde oder das Element des Siegels beschädigt ist oder die Verpackung entsiegelt bzw. geöffnet wurde.<BR><BR>4.2. Ansprüche des Kunden <BR><BR>Der Lizenzgeber und seine Lieferanten behalten sich vor, bei einer Verletzung der vorgenannten Garantie, die sich auf den Lizenzgeber beläuft, nach eigenem Ermessen zu handeln: mitinbegriffen ist (i) wenn überhaupt die Erstattung des Kaufpreises für die Lizenz, (ii) der Ersatz der defekten Software in dem dieses Produkt enthalten ist, oder (iii) die Korrektur der Mängel, "Bugs" oder Fehler innerhalb einer angemessenen Frist. Sie müssen die defekte Original-Software auf eigene Kosten mit einer Kopie Ihrer Quittung an den Lizenzgeber übergeben. Diese eingeschränkte Garantie ist nichtig, wenn der Defekt auf einen Unfall, Missbrauch oder fehlerhafte Anwendung zurückzuführen ist. Der Ersatz der Software wird für die Restzeit der ursprünglichen Garantiezeit gewährleistet.<BR><BR>4.3. Keine impliziten oder sonstigen Gewährleistungsansprüche <BR><BR>AUSNAHME DIESER GARANTIE UND ALLER GARANTIEN, ERKLÄRUNGEN ODER BESTIMMUNGEN in deren Umfang das Gleiche NICHT gewährt wird oder NICHT gewährt werden kann und oder DURCH DAS FÜR SIE IN IHREM RECHTSGEBIET GELTENDE GESETZ FÜR DAS PRODUKT LIMITIERT WIRD, WIRD DAS PRODUKT "WIE ES IST"  und ohne jegliche Gewährleistung verkauft und der Lizenzgeber macht keine Versprechungen ODER GARANTIEN, weder AUSDRÜCKLICH noch IMPLIZIT (DURCH DAS GESETZ, Gewohnheitsrecht, HANDELSBRAUCH oder anderweitig) hinsichtlich AUF ODER IN BEZUG AUF DAS PRODUKT ODER BESTANDTEILE DES PRODUKTS ODER auf andere erhaltenen Materialien, die mit dieser Vereinbarung oder anderweitig versehen sind.<BR><BR>Sie übernehmen alle Risiken und Verantwortlichkeiten für die Auswahl des Produktes um Ihre beabsichtigten Resultate zu erzielen, DIE SIE DURCH DIE INSTALLATION UND NUTZUNG DER SOFTWARE und durch die folgenden Ergebnisse des Produkts erhalten.<BR><BR>DER LIZENZGEBER GIBT KEINE GARANTIE DAFÜR, DASS DAS Produkt immer fehlerfrei arbeiten wird und/oder frei von Unterbrechungen oder Ausfällen ist oder dass die Software kompatibel mit allen Hard - oder Softwares ist.<BR><BR>Bis zur äußersten Grenze der rechtlichen Zulässigkeit schließt der Lizenzgeber alle Gewährleistungsansprüche, WEDER AUSDRÜCKLICHE NOCH EINSCHLIEßLICHE, ABER NICHT AUSSCHLIEßLICHE GARANTIEN AUF GEBRAUCHSTAUGLICHKEIT, NICHTVERLETZUNG DER RECHTE DRITTER, INTEGRATION, QUALITÄT ODER EIGNUNG FÜR EINEN BESTIMMTEN ZWECK IN BEZUG AUF DAS PRODUKT UND schriftliche Begleitmaterialien ODER deren Verwendung, mit ein.<BR><BR>EINIGE GERICHTSBARKEITEN gestatten nicht die Einschränkung indirekter Gewährleistungsansprüche, SODASS DIESE MÖGLICHERWEISE NICHT AUF SIE BEZOGEN SIND BZW. AUF SIE NICHT ZUTREFFEN. Sie bestätigen dies für den Fall, dass wenn das Produkt nicht mehr erreichbar ist oder aufgrund von einer Reihe von Faktoren EINSCHLIESSLICH der Wartung des Periodensystems, geplant oder ungeplant, aufgrund von höherer Gewalt, technischem Versagen der Software, Telekommunikation der Infrastruktur oder durch Verzögerung und Unterbrechung durch Viren, Denial Of Service Attacken oder schwankender Nachfrage und Aktionen und Unterlassungen durch Dritte, unerreichbar werden kann.<BR><BR>DER LIZENZGEBER übernimmt in dem Sinne ausdrücklich keine Haftung oder gibt keine Garantie für das System und/oder für die Software, über die Verfügbarkeit, Zugänglichkeit oder die Leistung dieser. DER LIZENZGEBER übernimmt keine Haftung für jeglichen Verlust von Daten während der Übermittlung jeglicher Mitteilungen, auch für den Verlust der Daten während der Kommunikation mit dem Lizenzgeber übernimmt dieser keine Haftung.<BR><BR>4.4. Beschränkte Haftung; KEINE HAFTUNG FÜR SCHÄDEN <BR><BR>SIE ÜBERNEHMEN DIE GESAMTEN KOSTEN FÜR SCHÄDEN, DIE DURCH DIE NUTZUNG DES PRODUKTS UND den darin enthaltenen oder mit dem Produkt verknüpften Informationen und durch die Interaktion (oder Fehler bei dem INTERACT) mit jeder anderen Hardware oder Software, die entweder durch den Lizenzgeber oder durch Dritte empfohlen wurde oder wird.<BR><BR>Bis zur äußersten Grenze des rechtlich zulässigen schließt der Lizenzgeber bzw. dessen Zulieferer und/oder seine Lizenzgeber vollkommen davon aus, FÜR SCHÄDEN mündig oder haftbar gemacht zu werden (einschließlich, und ohne Einschränkung, Schadensersatz aufgrund von VERLUST VON GEWINN, BUSINESS, VERLUST VON DATEN, VERLUST VON Firmenwert, ARBEITSUNTERBRECHUNGEN, Hardware oder Software oder den Ausfall durch STÖRUNG, Reparaturkosten, TIME-Wert oder andere VERMÖGENSSCHÄDEN). Dies gilt auch für Schäden, die AUS DER NUTZUNG ODER NICHT NUTZUNG DES Produkts oder der Inkompatibilität des Produktes mit jeder Hardware und oder Software hervorgehen. Selbst WENN auf die Möglichkeit solcher Schäden hingewiesen wurde, übernimmt der Lizenzgeber bzw. dessen Zulieferer und oder seine Lizenzgeber keine Verantwortung.<BR><BR>IN KEINEM FALL HAFTET DER LIZENZGEBER IHNEN GEGENÜBER für sämtliche Schäden eines oder mehrerer KLAGEANSPRÜCHE, weder VERTRAG, SCHULD ODER sonstige Kosten, die ÜBER DEN VON IHNEN FÜR DAS PRODUKT BEZAHLTEN Preis gehen. DIESE HAFTUNGSBESCHRÄNKUNG GILT NICHT für die Haftung im Todesfall oder Körperverletzung, soweit das geltende Recht eine solche Einschränkung nicht zulässt. Darüber hinaus gibt es Fälle, dass einige Gerichtsbarkeiten einen AUSSCHLUSS oder eine LIMITIERUNG der HAFTUNG FÜR FOLGESCHÄDEN nicht für zulässig halten, so kann es sein, dass dieser Haftungsausschluss unter Umständen NICHT FÜR SIE gilt.<BR><BR>5. Ihre Informationen und der Datenschutz des Lizenzgebers<BR><BR>5.1. Datenschutz<BR><BR>Sie erklären sich hiermit ausdrücklich damit einverstanden, dass der Lizenzgeber die Verarbeitung Ihrer personenbezogenen Daten nach den aktuellen Datenschutzrichtlinien für den Zeitpunkt der Wirksamkeit dieser Satzung, auf die in dieser Vereinbarung Bezug genommen wird, betreiben darf (diese Daten können durch den Lizenzgeber oder seine Vertriebspartner gesammelt werden).<BR><BR>Durch Abschluss dieses Vertrags erklären Sie, dass der Lizenzgeber die Informationen über Sie, wie Ihren Namen, Ihre E-Mail-Adresse und Kreditkarten-Informationen (letztere ausschließlich für den Zweck der vorliegenden Transaktion) sammeln und behalten kann. <BR><BR>Der Lizenzgeber arbeitet mit anderen Unternehmen und Einzelpersonen zusammen und gibt die entsprechenden Aufträge in Ihrem Namen auf. Beispiele umfassen die Auftragsbearbeitung, Lieferung von Paketen, die Versendung von Post und E-Mails, die Pflege von Kundenlisten, Datenanalyse, Marketingunterstützung, Verarbeitung von Kreditkartenzahlungen und Bereitstellung von kundenorientiertem Service.<BR><BR>Diese haben Zugang zu persönlichen Informationen, die zur Erfüllung ihrer Aufgaben dienen, aber sie dürfen diese nicht für andere Zwecke nutzen. Der Lizenzgeber veröffentlicht eine Datenschutzerklärung auf seiner Website und kann diese Richtlinien von Zeit zu Zeit nach eigenem Ermessen ändern.<BR><BR>Sie sollten sich die Datenschutzbestimmungen des Lizenzgebers durchlesen bevor Sie diesem Abkommen bzw. dieser Vereinbarung zustimmen. Dort ist eine detaillierte Erläuterung gegeben, wie Ihre Daten durch den Lizenzgeber gespeichert und verwendet werden. Wenn Sie im Namen einer Organisation sprechen bzw. diesem Abkommen zustimmen, stimmen Sie hiermit ausdrücklich zu, dass jedes Mitglied Ihrer Organisation (einschließlich der Mitarbeiter und der Auftragnehmer) über die Weitergabe der personenbezogenen Daten informiert ist und der Weitergabe und der weiteren Verwendung der Daten an bzw. durch den Lizenzgeber zustimmt.<BR><BR>Persönliche Daten werden durch den Lizenzgeber und/oder seine Vertriebspartner in dem Land verarbeitet, in dem sie gesammelt wurden, z.B. in den Vereinigten Staaten oder der Europäischen Union. Gesetze der Vereinigten Staaten zur Behandlung von personenbezogenen Daten sind möglicherweise weniger streng oder strenger als die Gesetze in Ihrem Land.<BR><BR>Solche Informationen werden nicht ohne Ihre vorherige Genehmingung zu kommerziellen Zwecken an Dritte weitergegeben.<BR><BR>6. Verschiedenes<BR><BR>6.1. Geltendes Recht, Gerichtsbarkeit und Gerichtsstand Dieses Abkommen ist geregelt und ausgelegt und durchgesetzt in Übereinstimmung mit den Gesetzen des Commonwealth of Virginia, USA ohne Bezugnahme auf Kollisionsnormen und Prinzipien. Dieses Abkommen wird nicht durch das Übereinkommen der Vereinten Nationen über Verträge über den internationalen Warenkauf, deren Anwendung ausdrücklich ausgeschlossen und ausgeschlossen wird.Die Gerichte im Fairfax County, Commonwealth of Virginia haben die ausschließliche Zuständigkeit für alle Streitigkeiten aus diesem Vertrag zu entscheiden. Sie bestätigen, dass ein solcher Streitfall in den USA durchgeführt werden soll und dass jede Maßnahme, Streitigkeiten, Meinungsverschiedenheiten oder Ansprüche, die eingeleitet werden, basierend auf dieser Vereinbarung oder aus dem Zusammenhang mit dieser Vereinbarung einer angeblichen Verletzung davon, ausschließlich durch die Gerichte des Commonwealth of Virginia strafrechtlich verfolgt wird, und Sie, soweit nach anwendbarem Recht, verzichten<BR><BR>6.2. Klagefrist <BR><BR>Keine Maßnahmen, unabhängig von der Form, die sich aus den Transaktionen im Rahmen dieses Abkommens ergeben, dürfen von beiden Parteien festgesetzt werden, wenn mehr als ein (1) Jahr nach dem der Schaden entstanden  oder festgestellt wurde vergangen ist, außer es wird eine Klage auf Verletzung der Rechte des geistigen Eigentums innerhalb der maximal anwendbaren gesetzlichen Frist erhoben.<BR><BR>6.3. Gesamte Vereinbarung; Salvatorische Klausel; <BR><BR>Kein Verzicht<BR><BR>Diese Vereinbarung stellt die gesamte Vereinbarung zwischen Ihnen und dem Lizenzgeber dar und ersetzt alle anderen früheren Vereinbarungen, Vorschläge, Mitteilungen oder Werbungen, in mündlicher oder schriftlicher Form in Bezug auf das Produkt oder den Gegenstand dieses Abkommens, das den Lizenzgeber und Sie einschränken kann oder Änderungen der Anwendbarkeit der Bestimmungen dieses Abkommens durch eine vorherige, gleichzeitige oder nachfolgende schriftliche Vereinbarung mit einem Verweis auf diesen Abschnitt 6.3 des Abkommens, in der ausdrücklich diese Einschränkung oder Änderungen vorgesehen sind, beinhalten kann.<BR><BR>Sie bestätigen, dass Sie diesen Vertrag gelesen und verstanden haben und zustimmen, an seine Bedingungen gebunden zu sein. Sollten einzelne Bestimmungen dieses Vertrags von einem zuständigen Gericht für als ungültig, nichtig oder aus irgendeinem Grund nicht durchsetzbar, im Ganzen oder in Teilen, erachtet werden, ist diese Bestimmung enger auszulegen, so dass es legal und durchsetzbar wird, und das gesamte Abkommen wird nicht deswegen scheitern, und die Balance des Abkommens wird in vollem Umfang weiterhin gelten, soweit dies weiterhin gesetzlich zulässig ist.<BR><BR>Ein Verzicht auf eine Verletzung der Bestimmungen dieses Abkommens wird als Verzicht auf eine vorherige, gleichzeitige oder nachfolgende Verletzung angesehen und wird erst wirksam, wenn eine schriftliche Vorlage erfolgt.<BR><BR>6.4. Kontaktinformationen <BR><BR>Sollten Sie irgendwelche Fragen zu dieser Vereinbarung haben oder wenn Sie wünschen den Lizenzgeber aus irgendeinem Grund zu kontaktieren, so kontaktieren Sie bitte Customer Abteilung unserer Reseller/Dealer in Deutschland: info@konsileri-crm.de.<BR><BR>Copyright © 2007-2010 TriDaVinchi Ltd. und ihre Lizenzgeber. Alle Rechte vorbehalten. Das Produkt, einschließlich der Software und der dazugehörigen Dokumentation sind durch Copyright-Gesetze und internationale Copyright-Verträge sowie andere Gesetze zum geistigen Eigentum und Verträge urheberrechtlich geschützt.<delimeter>
please_change_rights = Die Konsileri CRM wurde in folgenden Ordner Ihres Webservers installiert:<BR>{dir}<delimeter>
installation_wait_process = Bitte gedulden Sie sich. Die Konsileri CRM wird installiert.<delimeter>
installation_permission = Nach der Installation der Software weden folgende Zugriffrechte eingestellt:<delimeter>
installation_permission_files = für Dateien:<delimeter>
installation_permission_dirs = für Ordner:<delimeter>
';




function load_dump (& $path_array, & $files_array) {
include "dump.php";

}
define ('SERVICE', 'dacons');
//define ('$INSTALL_DIR', '');
//define ('$INSTALL_DIR', 'crm/');
$INSTALL_DIR = 'crm/';
/* define('DEFLICENSE', 'VGWS-USGS-TGDF-UHXE-RHHS-QQEQ-ZGEX'); */
$STEP_DATA_FILE = dirname(__FILE__).'/'.$INSTALL_DIR.'step_data.xml';

$installer_lang = array();
$cur_lang = '';
class xmlParser {
function RewriteConfig($constant_arr, $path) {
    if (!is_file($path) || !is_array($constant_arr) || !sizeof($constant_arr)) {
        return false;
    }
    $configXml = file_get_contents($path);
    $configArray = $this->XmlUnpack($configXml);
    foreach($constant_arr as $key => $value) {
        $configArray[$key] = $value;
    }
    $configXml = $this->XmlPack($configArray, true);
    $fp = fopen($path, "w");
    fwrite($fp, $configXml);
    fclose($fp);
    return true;
}

function XmlUnpack($data) {
    $xml = array();
    if (preg_match_all('|<(\w+?)>(.*?)</\1>|s', $data, $matches)) {
        foreach ($matches[1] as $key => $value) {
            if (!isset($xml[$value])) {
            $xml[$value] = $matches[2][$key];
            } else {
                if (!is_array($xml[$value])) {
                    $oldValue = $xml[$value];
                    $xml[$value] = array();
                    $xml[$value][] = $oldValue;
                }
                $xml[$value][] = $matches[2][$key];
            }
        }
    }
    return $xml;
}

function XmlPack($xml, $userFormat = false) {
    $result = '';
    if (is_array($xml)) {
        foreach ($xml as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $str) {
                    $result .= '<'.$key.'>';
                    if ($userFormat) {
                        $result .= "\n";
                    }
                    $result .= $this->XmlPack($str, $userFormat);
                    $result .= '</'.$key.'>';
                    if ($userFormat) {
                        $result .= "\n";
                    }
                }
            } else {
                $result .= '<'.$key.'>'.$val.'</'.$key.'>';

                if ($userFormat) {
                    $result .= "\n";
                }
            }
        }
    } else {
        $result = $xml;
    }
    return $result;
}
}
$xmlParserObj = new xmlParser();

/*
eval (base64_decode("ZnVuY3Rpb24gQ29uZGVuY2VTdHJpbmcoJHN0cil7IHJldHVybiBzdHJfcmVwbGFjZSgiLSIsICIiLCAkc3RyKTsgfTsgZnVuY3Rpb24gRXhwYW5kU3RyaW5nKCRzdHIpeyByZXR1cm4gdHJpbShjaHVua19zcGxpdCgkc3RyLCA1LCAiLSIpLCAiLSIpOyB9IGZ1bmN0aW9uIEVuY29kZSgkdmFsLCAkYmFzZSwgJGxlbikgeyBpZiAoIWlzX3N0cmluZygkdmFsKSkgJHZhbCA9IHN0cnZhbCgkdmFsKTsgJHZhbCA9IGJhc2VfY29udmVydCgkdmFsLCAkYmFzZSwgMzUpOyAkdmFsID0gc3RyX3JlcGVhdCgiMCIsICRsZW4gLSBzdHJsZW4oJHZhbCkpIC4gJHZhbDsgJHZhbCA9IHN0cnRvdXBwZXIoJHZhbCk7ICR2YWwgPSBzdHJfcmVwbGFjZSgiMCIsICJaIiwgJHZhbCk7IHJldHVybiAkdmFsOyB9IGZ1bmN0aW9uIE1ha2VTVU4oKSB7IHJldHVybiBFbmNvZGUoY3JjMzIocGhwX3VuYW1lKCJzIG4gbSIpKSwgMTAsIDcpOyB9IGZ1bmN0aW9uIE1ha2VEUigpIHsgcmV0dXJuIEVuY29kZShjcmMzMihyZWFscGF0aCgkX1NFUlZFUlsiRE9DVU1FTlRfUk9PVCJdKSksIDEwLCA3KTsgfSBmdW5jdGlvbiBNYWtlRFMoKSB7IHJldHVybiBFbmNvZGUoY3JjMzIoZGVjaGV4KGRpc2tfdG90YWxfc3BhY2UocmVhbHBhdGgoJF9TRVJWRVJbIkRPQ1VNRU5UX1JPT1QiXSkpKSksIDEwLCA3KTsgfSBmdW5jdGlvbiBFbmNvZGVBUigkbGljZW5zZSkgeyAkU1VOID0gTWFrZVNVTigpOyAkRFIgPSBNYWtlRFIoKTsgJERTID0gTWFrZURTKCk7ICRsaWNlbnNlID0gc3RycmV2KENvbmRlbmNlU3RyaW5nKCRsaWNlbnNlKSk7ICRtYXhDb2RlZExpYyA9ICRsaWNlbnNlIC4gc3RydG91cHBlcihiYXNlX2NvbnZlcnQocmFuZCgxLCAzNSksIDEwLCAzNikpIC4gJFNVTiAuICREUiAuICREUzsgcmV0dXJuIEV4cGFuZFN0cmluZygkbWF4Q29kZWRMaWMpO30="));
*/

function setLang($lang, &$installer_lang) {
global $lang_ru, $lang_en, $lang_de, $cur_lang;
   $cur_lang = $lang;
   //$explode_str = (strrpos ($lang_en, "\r\n") === false) ? "\r\n" :chr(10);
   $explode_str = "<delimeter>";
   switch ($lang) {
      case 'ru':
      $lang_arr = explode($explode_str, $lang_ru);
         break;
      case 'en':
      $lang_arr = explode($explode_str, $lang_en);
         break;
      case 'de':
      $lang_arr = explode($explode_str, $lang_de);
         break;
      default :
         break;
   }
   foreach ($lang_arr as $key => $val) {
   		$lang_arr [$key] = trim ($val);
   }
   foreach($lang_arr as $key => $value){
      if (preg_match('#(\w+?)\s*=\s*(.*)#', $value, $matches) && $value[0] != '#') {
         $installer_lang[$matches[1]] = $matches[2];
      }
   }
}

$isStepData = @touch($STEP_DATA_FILE);

if (!$isStepData) {
        echo '<font color="red">You don\'t  have permissions to ('.dirname (__FILE__).'/'.$INSTALL_DIR.'). Please, create this directory and set permissions to it on 0777. After installation turn it to 0755.</font>';
		die ();
}


if (isset($_GET['lang']) && $_GET['lang']) {
   $confParams = array('lang'=>$_GET['lang']);
   $xmlParserObj->RewriteConfig($confParams, $STEP_DATA_FILE);
   setLang($_GET['lang'], $installer_lang);
}

if (file_exists($STEP_DATA_FILE)) {
   $tmpConfigXml = file_get_contents($STEP_DATA_FILE);
   $tmpConfigArr = $xmlParserObj->XmlUnpack($tmpConfigXml);
   if (is_array($tmpConfigArr) && !empty($tmpConfigArr)) {
      @$_lang = $tmpConfigArr['lang'];
	  setLang($_lang, $installer_lang);
      
   }
}

if (isset ($_lang)) {
   $_lang_tmp = (!isset($_lang) || !$_lang)?'en':$_lang;
   setLang($_lang_tmp, $installer_lang);
}

if (empty ($installer_lang)) {
	setLang('en', $installer_lang);
}

   function br2nl($text)
   {
       $text = str_replace("<br>","
",$text);
       return $text;
   }

$wininst = ((isset($_GET['wininst']) && $_GET['wininst'] == '1') || (isset($_POST['wininst']) && $_POST['wininst'] == '1'))?1:0;
$_lic = ((isset($_GET['_lic']) && $_GET['_lic'] == '1') || (isset($_POST['_lic']) && $_POST['_lic'] == '1'))?1:0;

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE><?php echo $installer_lang['installation_title']; ?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UFT-8">
<STYLE TYPE="TEXT/CSS">
<!--
BODY {padding: 0 0 0 0; margin: 0 0 0 0; color: #000000; font-family: Arial, Tahoma, sans-serif; font-size: 12px; background: url(?image=body_back.png) repeat-x #88FE1A;}
#logo {position: absolute; z-index: 3; top: 0; right: 0;}

a:link,a:visited {text-decoration: underline; color: #000000;}
a:active {text-decoration: none; color: #999999;}
a:hover {text-decoration: none; color: #000000;}
td, tr, div, p, body, button {color: #000000; font-size : 12px; font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;}
input, select, textarea {color: #000000; font-size : 12px;  font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif; width:200px;}
h1, h2, h3, h4, h5, h6 {color: #000000; font-family: Tahoma, Arial, Helvetica, sans-serif; margin-top:0px; margin-bottom:0px;}
.small {color: #999999; font-size : 9px; font-family : Tahoma, Verdana, Arial, Helvetica, sans-serif;}
.red {color: #FF0000;}
.green {color: #00AA00;}
.border {border: #999999 solid; border-width: 1px 0px 0px 1px;}
.line {border: #999999 solid; border-width: 0px 1px 1px 0px;}
.form {margin:0; padding:0;}
.radio_b {width:20px;}
.white_bg {background-color:#FFFFFF; border: 1px solid #000000; width:550px; height:300px; text-align:center; padding:20px;}
-->
</STYLE>
<SCRIPT>
function SetStatus(value) {
    window.navigate("javascript: void(\"" + value + "\")");
}
function Next() {
        submitConfigForm();
//        document.forms.configForm.
//    alert("next");
}
function Prev() {
        document.forms.backForm.submit();
//    alert("prev");
}
function Cancel() {
    SetStatus("canceled");
}

window.installerNext = Next;
window.installerPrev = Prev;
window.installerCancel = Cancel;

</SCRIPT>

</HEAD>
<BODY BGCOLOR="#88FE1A">
<DIV id=logo><IMG SRC="?image=logo_reg.png" ALT="K" /></DIV>
<CENTER>

<DIV ID="install_progress" STYLE="display:none; height:100%;" ALIGN="center">
<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<DIV ALIGN="center">
<DIV ID="prdiv" STYLE="border: 1px solid black; width: 400px; position: relative;" ALIGN="left"><DIV ID="stdiv" STYLE="border: 1px solid black; width: 40px; background-color: green; position: relative;"></DIV></DIV></DIV><BR>
<H3><?php echo $installer_lang['installation_wait_process']; ?></H3>
</TD></TR></TABLE>
</TD></TR></TABLE>
</DIV>

<?php /*
<div style='display:none;' id='phptest'>

<TABLE WIDTH="550" height="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="25" CELLSPACING="0">
<TR>
<TD ALIGN="CENTER">







<h3><?php echo $installer_lang['installation_php_test']; ?></h3><br>

<div style="display:none;" id="php_present"><?php print 'php'; print '_present'; ?></div>

<span class="red">
<h5 class="red"><?php echo $installer_lang['installation_unavailable']; ?></h5><br>
<?php echo $installer_lang['installation_unavailable_text']; ?>
</span>

</TD>
</TR>
</TABLE>
</div>
*/ ?>
<DIV ID="main" STYLE="display:block;">
<?php
if (!isset($_GET['step']) && !isset($_GET['lang']) && (!isset($_lang) || !$_lang)) {
?>
<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<!--
<H2><A HREF="?step=0&lang=en">
<?php echo $installer_lang['installation_language_en']; ?>
</A></H2>
<BR>
-->
<H2><A HREF="?step=0&lang=de"><?php echo $installer_lang['installation_language_de']; ?></A></H2>
</TD></TR></TABLE>
</TD></TR></TABLE>
<?php }

define('INSTALLED_OK_LOCKFILE', dirname(__FILE__).'/'.$INSTALL_DIR.'dacons-installed');
if (file_exists(INSTALLED_OK_LOCKFILE)) {
?>

<SCRIPT>
window.installerNext = Cancel;
window.installerPrev = Cancel;
</SCRIPT>


<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<H3><?php echo $installer_lang['installation_prog_info']; ?></H3>
<BR>

<SPAN CLASS="red">
<H3 CLASS="red"><?php echo $installer_lang['installation_unavailable']; ?></H3><BR>
<?php echo $installer_lang['installation_error_installed']; ?>
</SPAN>

</TD></TR></TABLE>
</TD></TR></TABLE>

<?php } else {



if (file_exists($STEP_DATA_FILE)) {
   $tmpConfigXml = file_get_contents($STEP_DATA_FILE);
   $tmpConfigArr = $xmlParserObj->XmlUnpack($tmpConfigXml);
   if (is_array($tmpConfigArr) && !empty($tmpConfigArr)) {
      if (!isset($_GET['step'])) $_GET['step'] = (isset($tmpConfigArr['step']) && $tmpConfigArr['step'])?$tmpConfigArr['step']:1;
      $_host = @$tmpConfigArr['db_host'];
      $_user = @$tmpConfigArr['db_user'];
      $_password = @$tmpConfigArr['db_password'];
      $_dbname = @$tmpConfigArr['db_base'];

      $_main_host = @$tmpConfigArr['main_host'];
      $_dacons_mail_from = @$tmpConfigArr['dacons_mail_from'];
      $_dacons_admin_email = @$tmpConfigArr['dacons_admin_email'];

      $_mailer_type = @$tmpConfigArr['mailer_type'];
      $_mailer_smtp_host = @$tmpConfigArr['mailer_smtp_host'];
      $_mailer_smtp_port = @$tmpConfigArr['mailer_smtp_port'];
      $_permission_files = @$tmpConfigArr['permission_files'];
      $_permission_dirs = @$tmpConfigArr['permission_dirs'];
   }
}
?>


<?php // ========================== STEP0 ==========================
if ($_GET['step'] == '0') {
unset ($_SESSION ['INSTALL_DIR']);
//$disp = (!$isStepData)?'style="display:none;"':'';
?>

<FORM METHOD="POST" ACTION="?step=1" CLASS="form" NAME="LicForm" ID="LicForm">
<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<H3><?php echo $installer_lang['installation_agreement']; ?></H3><BR>

<TEXTAREA ROWS="10" STYLE="width:100%; height:300px;" readonly><?php
echo preg_replace(array("/<br>/", "/<BR>/"), array("\n", "\n"), $installer_lang['installation_license_manager']);
?></TEXTAREA>

<BR><BR>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" ALIGN="CENTER">
<TR>
<TD><INPUT TYPE="radio" NAME="Agree" ID="AgreeYes" VALUE="1" STYLE="width:30px;">
</TD>
<TD><LABEL FOR="AgreeYes"><?php echo $installer_lang['installation_agree_yes']; ?></LABEL></TD>
</TR>
<TR>
<TD><INPUT TYPE="radio" NAME="Agree" ID="AgreeNo" VALUE="0" STYLE="width:30px;"></TD>
<TD><LABEL FOR="AgreeNo"><?php echo $installer_lang['installation_agree_no']; ?></LABEL></TD>
</TR>
</TABLE>

<SCRIPT LANGUAGE="JavaScript">
function submitConfigForm() {
if (document.all.AgreeYes.checked != true)
        {alert('<?php echo trim ($installer_lang['installation_agree_deny']); ?>');
        return false;
        }
        else {
        document.forms.LicForm.submit();
        return true;
        }
}
</SCRIPT>
<BR>
<?php if (!$wininst) { ?>
<INPUT TYPE="button" onClick="Next();" VALUE="     <?php echo $installer_lang['installation_but_next']; ?>     ">
<? } ?>
</TD></TR></TABLE>
</TD></TR></TABLE>
</FORM>



<?php // ========================== STEP1 ==========================
}
else if ($_GET['step'] == '1') {
//$disp = (!$isStepData)?'style="display:none;"':'';
echo '<div id="1st" '/*.$disp*/.'>';
?>




<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<FORM METHOD="POST" ACTION="?step=2" CLASS="form" NAME="configForm">
<INPUT TYPE="hidden" NAME="wininst" VALUE="<?php echo $wininst; ?>">
<SCRIPT LANGUAGE="JavaScript">
function submitConfigForm() {
   if (doCheckForm()) document.forms.configForm.submit();
}
function doCheckForm() {
   var oForm = document.forms.configForm;
   for (var i=0; i<oForm.elements.length; i++) {
      if (!oForm.elements[i].value) {
         alert('<?php echo $installer_lang['installation_all_req']; ?>');
         return false;
      }
   }
return true;
}
</SCRIPT>

<H3><?php echo $installer_lang['installation_base_params']; ?></H3>
<BR>

<? if (ASK_EMAIL) : ?>
<B><?php echo $installer_lang['installation_base_title']; ?></B><BR><BR>
<TABLE WIDTH="550" border=0 cellpadding=5 cellspacing=0 CLASS="border">

<? /*
<TR>
<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_main_host']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="main_host" VALUE="<?php 
echo ((isset($_main_host) && $_main_host)) 
? $_main_host
: trim ($_SERVER['SERVER_NAME'], '/').
  rtrim (dirname ($_SERVER ['SCRIPT_NAME']), '/').
  '/'.$INSTALL_DIR
?>"></TD>
</TR>
<TR>
*/ ?>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_admin_email']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="dacons_mail_from" VALUE="<?php echo ((isset($_dacons_mail_from) && $_dacons_mail_from)?$_dacons_mail_from:'')?>"></TD>
</TR>
<?php /*
<TR>
<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_mail_from']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="dacons_admin_email" VALUE="<?php echo ((isset($_dacons_admin_email) && $_dacons_admin_email)?$_dacons_admin_email:'')?>"></TD>
</TR>
*/ ?>
<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_mailer_type']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<SELECT NAME="mailer_type" onChange="javascript: document.getElementById('msh_field').style.display = (document.forms.configForm.mailer_type.value!='smtp')?'none':'block';">
<OPTION VALUE="mail" <?php echo (isset($_mailer_type) && $_mailer_type=='mail')?'selected':''; ?> >
<?php echo $installer_lang['installation_mailer_type_mail']; ?>
</OPTION>
<OPTION VALUE="smtp" <?php echo (isset($_mailer_type) && $_mailer_type=='smtp')?'selected':''; ?> >
<?php echo $installer_lang['installation_mailer_type_smtp']; ?>
</OPTION>
<?PHP /*
<OPTION VALUE="sendmail" <?php echo (isset($_mailer_type) && $_mailer_type=='sendmail')?'selected':''; ?> >
<?php echo $installer_lang['installation_mailer_type_sendmail']; ?>
</OPTION>
*/ ?>
</SELECT>
</TR>
</TABLE>


<TABLE WIDTH="550" border=0 cellpadding=5 cellspacing=0 CLASS="border" STYLE="display: <?php echo (/*!isset($_mailer_type) || */$_mailer_type=='smtp')?'block':'none'; ?>" ID="msh_field">

<TR>
<TD WIDTH="99%" CLASS="line"><?php echo $installer_lang['installation_mailer_smtp_host']; ?></TD>
<TD WIDTH="1%" CLASS="line"><INPUT TYPE="text" NAME="mailer_smtp_host" VALUE="<?php echo ((isset($_mailer_smtp_host) && $_mailer_smtp_host)?$_mailer_smtp_host:'localhost')?>"></TD>
</TR>

<TR>
<TD WIDTH="99%" CLASS="line"><?php echo $installer_lang['installation_mailer_smtp_port']; ?></TD>
<TD WIDTH="1%" CLASS="line"><INPUT TYPE="text" NAME="mailer_smtp_port" VALUE="<?php echo ((isset($_mailer_smtp_port) && $_mailer_smtp_port)?$_mailer_smtp_port:'25')?>"></TD>
</TR>

</TABLE>

<BR>
<? endif; ?>


<B>
<?php echo $installer_lang['installation_db_title']; ?>
</B><BR>
<BR>

<?php if ($isStepData) { ?>
<?php echo $installer_lang['installation_intro_step_f']; ?>
<?php } ?>
<BR>
<BR>

<TABLE WIDTH="550" border=0 cellpadding=5 cellspacing=0 CLASS="border">
<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_bd_server']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="dbhost" VALUE="<?php echo ((isset($_host) && $_host)?$_host:'localhost')?>"></TD>
</TR>

<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_db_name']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="dbbase" VALUE="<?php echo ((isset($_dbname) && $_dbname)?$_dbname:'')?>"></TD>
</TR>


<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_db_user']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="dbuser" VALUE="<?php echo ((isset($_user) && $_user)?$_user:'')?>"></TD>
</TR>
<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_db_pass']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="password" NAME="dbpassword" VALUE="<?php echo ((isset($_password) && $_password)?$_password:'')?>"></TD>
</TR>
</TABLE>





<BR>
<B>
<?php echo $installer_lang['installation_permission']; ?>
</B><BR>
<BR>

<TABLE WIDTH="550" border=0 cellpadding=5 cellspacing=0 CLASS="border">
<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_permission_files']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="permission_files" VALUE="<?php echo ((isset($_permission_files) && $_permission_files)?$_permission_files:DEFAULT_FILE_RIGHTS)?>"></TD>
</TR>

<TR>

<TD WIDTH="99%" CLASS="line">
<?php echo $installer_lang['installation_permission_dirs']; ?>
</TD>
<TD WIDTH="1%" CLASS="line">
<INPUT TYPE="text" NAME="permission_dirs" VALUE="<?php echo ((isset($_permission_files) && $_permission_dirs)?$_permission_dirs:DEFAULT_DIR_RIGHTS)?>"></TD>
</TR>
</TABLE>

</FORM>

<BR>
<TABLE WIDTH="550" BORDER="0" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0">
<TR>
<TD ALIGN="CENTER">
<?php /*if ($isStepData) {*/ ?>
<?php if (!$wininst) { ?>
<INPUT type=button VALUE="     <?php echo $installer_lang['installation_but_next']; ?>     " onClick="Next()">
<? } ?>
<?php /*} else { ?>
<B CLASS="red"><?php echo $installer_lang['installation_unavailable']; ?></B><BR>

<BR>
<SPAN CLASS="red"><?php echo $installer_lang['installation_no_rights_f']; ?><?php echo dirname(__FILE__); ?><?php echo $installer_lang['installation_no_rights_s']; ?></SPAN>

<?php } */?>
<FORM METHOD="POST" ACTION="?step=<?php echo ((int)$_GET['step']); ?>" CLASS="form"  name="backForm">
<INPUT TYPE="hidden" NAME="wininst" VALUE="<?php echo $wininst; ?>">
</FORM>

</TD>
</TR>
</TABLE>




</TD></TR></TABLE>
</TD></TR></TABLE>

</DIV>

<?php // ========================== STEP2 ==========================
 }
 else if ($_GET['step'] == '2') { ?>

<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<H3><?php echo $installer_lang['installation_testing']; ?></H3><BR>

<?php

$dbHost         = @$_POST['dbhost'];
$dbUser         = @$_POST['dbuser'];
$dbPassword     = @$_POST['dbpassword'];
$dbBase         = @$_POST['dbbase'];
//$mainHost   = trim (@$_POST['main_host'], '/');
/*
//$INSTALL_DIR = str_replace ($_SERVER ['HTTP_HOST'], '', $mainHost, $__count=1);
$INSTALL_DIR = str_replace ($_SERVER ['HTTP_HOST'], '', $mainHost, $__count=1);
//echo "INSTALL_DIR: ". $INSTALL_DIR."<br>";
$INSTALL_DIR = str_replace (dirname ($_SERVER ['PHP_SELF']), '', $INSTALL_DIR, $__count=1);
//echo "INSTALL_DIR: ". $INSTALL_DIR."<br>";
$INSTALL_DIR = trim ($INSTALL_DIR, '/').'/';
*/
/*
echo "__FILE__:".__FILE__."<br>";
echo "mainHost: ". $mainHost."<br>";
echo "PHP_SELF: ".$_SERVER ['PHP_SELF']."<br>";
echo "DOCUMENT_ROOT: ".$_SERVER ['DOCUMENT_ROOT']."<br>";
echo "<pre>";
print_r ($_SERVER);
die ($INSTALL_DIR);
*/
//$_SESSION ['INSTALL_DIR'] = $INSTALL_DIR;
$STEP_DATA_FILE = dirname(__FILE__).'/'.$INSTALL_DIR.'step_data.xml';
$daconsMailFrom = @$_POST['dacons_mail_from'];
$daconsAdminEmail = @$_POST['dacons_admin_email'];
if (empty ($daconsAdminEmail)) $daconsAdminEmail = $daconsMailFrom;

$MailerType = @$_POST['mailer_type'];
$MailerSmtpHost = @$_POST['mailer_smtp_host'];
$MailerSmtpPort = @$_POST['mailer_smtp_port'];
$permission_files = @$_POST['permission_files'];
$permission_dirs = @$_POST['permission_dirs'];

if (file_exists($STEP_DATA_FILE) && !$dbHost) {
   $tmpConfigXml = file_get_contents($STEP_DATA_FILE);
   $tmpConfigArr = $xmlParserObj->XmlUnpack($tmpConfigXml);
   if (is_array($tmpConfigArr) && !empty($tmpConfigArr)) {
      $dbHost = $tmpConfigArr['db_host'];
      $dbUser = $tmpConfigArr['db_user'];
      $dbPassword = $tmpConfigArr['db_password'];
      $dbBase = $tmpConfigArr['db_base'];
      $mainHost = $tmpConfigArr['main_host'];
      $daconsMailFrom = $tmpConfigArr['dacons_mail_from'];
      $daconsAdminEmail = $tmpConfigArr['dacons_admin_email'];

      $MailerType = $tmpConfigArr['mailer_type'];
      $MailerSmtpHost = $tmpConfigArr['mailer_smtp_host'];
      $MailerSmtpPort = $tmpConfigArr['mailer_smtp_port'];
      $permission_files = $tmpConfigArr['permission_files'];
      $permission_dirs = $tmpConfigArr['permission_dirs'];
   }
}

$_mainHost = substr ($mainHost, 0, strpos ($mainHost, '/'));
//die ($_mainHost);
//$_mainHost_arr = explode ('/', $mainHost);
//$_mainHost = $_mainHost_arr [0];
define('SYSTEMTEST_MAIN_HOST_EXISTS', true);
/*
$fp = @fsockopen($_mainHost, 80, $errno, $errstr);
if (!$fp) {
   define('SYSTEMTEST_MAIN_HOST_EXISTS', false);
} else {
   define('SYSTEMTEST_MAIN_HOST_EXISTS', true);
}
*/

if ($MailerType == 'smtp') {

$fp = @fsockopen($MailerSmtpHost, $MailerSmtpPort, $errno, $errstr);
if (!$fp) {
   define('SYSTEMTEST_SMTP_HOST_EXISTS', false);
} else {
   define('SYSTEMTEST_SMTP_HOST_EXISTS', true);
}
}
else {
define('SYSTEMTEST_SMTP_HOST_EXISTS', true);
}

$confParams = array('step'=>'2', 'db_host'=>$dbHost, 'db_user'=>$dbUser, 'db_password'=>$dbPassword, 'db_base'=>$dbBase, /*'main_host'=>$mainHost, */'dacons_mail_from'=>$daconsMailFrom, 'dacons_admin_email'=>$daconsAdminEmail,
'mailer_type'=>$MailerType, 'mailer_smtp_host'=>$MailerSmtpHost, 'mailer_smtp_port'=>$MailerSmtpPort, 
'permission_files'=>$permission_files, 'permission_dirs'=>$permission_dirs);
if (file_exists($STEP_DATA_FILE)) {
   $xmlParserObj->RewriteConfig($confParams, $STEP_DATA_FILE);
}

$phpVersionNeeded = '5.1';
$mysqlVersionNeeded = '4.1';
$diskFreeSpaceNeeded = 10;
$phpRegisterGlobalsNeeded = '';
$phpFileUploadsNeeded = "1";
$phpSessionSaveHandlerNeeded = 'files';
$phpSessionUseCookiesNeeded = "1";
$phpSessionAutoStartNeeded = "";
$phpMysqlLibNeeded = '1';
$phpMysqliLibNeeded = '0';
$phpShortOpenTagNeeded = '1';

define('TOUCH_TEST_FILE', 'test.txt');



function getIniVar($var) {
    $res = strtolower(ini_get($var));
    switch ($res) {
        case '0':
        case 'off':
        case 'false':
        case 'no':
            $res = '';
            break;
        case '1':
        case 'on':
        case 'true':
        case 'yes':
            $res = '1';
            break;
        default:
            break;
    }
    return $res;
}

$e = error_reporting ( 0 );
$diskFreeSpace = floor(disk_free_space(dirname(__FILE__)) / (1024 * 1024));
if ( $diskFreeSpace == 0)
{
	$dummy_file = dirname(__FILE__).'/'.$INSTALL_DIR . 'dummy.dat';
	$fp = fopen ( $dummy_file, 'w' );	
	for ( $i = 0; $i < $diskFreeSpaceNeeded; ++ $i )
	{
		fputs ($fp, str_repeat ('0123456789', 100000));
	}
	fclose ( $fp );
	$diskFreeSpace = filesize ($dummy_file) / 1000000;
	unlink ($dummy_file);
}
error_reporting ( $e );
$touchFilename = dirname(__FILE__).'/'.$INSTALL_DIR.TOUCH_TEST_FILE;
$touchResult = @touch($touchFilename);
define('SYSTEMTEST_DISK_WRITE', $touchResult);
if ($touchResult) {
    unlink($touchFilename);
}
define('SYSTEMTEST_DISK_FREESIZE', $diskFreeSpace >= $diskFreeSpaceNeeded);
define('SYSTEMTEST_DISK', SYSTEMTEST_DISK_FREESIZE && SYSTEMTEST_DISK_WRITE);

//$phpRegisterGlobals = getIniVar('register_globals');
//$phpFileUploads = getIniVar('file_uploads');
$phpSessionSaveHandler = getIniVar('session.save_handler');
$phpSessionUseCookies = getIniVar('session.use_cookies');
$phpSessionAutoStart = getIniVar('session.auto_start');
$phpShortOpenTag = getIniVar('short_open_tag');

define('SYSTEMTEST_PHP_VERSION_OK', version_compare(PHP_VERSION, $phpVersionNeeded) > 0);
//define('SYSTEMTEST_PHP_REGISTER_GLOBALS',  $phpRegisterGlobals == $phpRegisterGlobalsNeeded);
//define('SYSTEMTEST_PHP_FILE_UPLOADS', $phpFileUploads == $phpFileUploadsNeeded);
define('SYSTEMTEST_PHP_SESSION_SAVE_HANDLER', $phpSessionSaveHandler == $phpSessionSaveHandlerNeeded);
define('SYSTEMTEST_PHP_SESSION_USE_COOKIES', $phpSessionUseCookies == $phpSessionUseCookiesNeeded);
define('SYSTEMTEST_PHP_SESSION_AUTO_START',  $phpSessionAutoStart == $phpSessionAutoStartNeeded);
define('SYSTEMTEST_PHP_SHORT_OPEN_TAG',  $phpShortOpenTag == $phpShortOpenTagNeeded);
define('SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT', function_exists('mysql_connect'));
//define('SYSTEMTEST_PHP_MYSQLI_FUNC_PRESENT', function_exists('mysqli_connect'));


$is_win = (strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN');
if ($is_win) {
   $extension_dir_ = ini_get('extension_dir');
   define('SYSTEMTEST_PHP_EXTENSION_DIR', (file_exists($extension_dir_.'/php_mysql.dll')));
   $loaded_extensions_ = get_loaded_extensions();
   define('SYSTEMTEST_PHP_MYSQL_LIB', (in_array('mysql', $loaded_extensions_)));

   $system_root = $_ENV['SystemRoot'].'/system32';
   define('SYSTEMTEST_PHP_SYS_MYSQL_LIB', (file_exists($system_root.'/libmysql.dll')));

   define('SYSTEMTEST_PHP_SYS_MYSQL_SUPPORT', (file_exists($system_root.'/php5ts.dll') && file_exists($system_root.'/php5ts.lib')));
}

define('SYSTEMTEST_PHP', /*SYSTEMTEST_PHP_FILE_UPLOADS && SYSTEMTEST_PHP_REGISTER_GLOBALS*/ /*&& SYSTEMTEST_PHP_SESSION_AUTO_START && */SYSTEMTEST_PHP_SESSION_SAVE_HANDLER && SYSTEMTEST_PHP_SESSION_USE_COOKIES && SYSTEMTEST_PHP_VERSION_OK && SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT /*&& SYSTEMTEST_PHP_MYSQLI_FUNC_PRESENT*/);

if (SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT) {
    $link = @mysql_connect($dbHost, $dbUser, $dbPassword);
    if ($link) {
        define('SYSTEMTEST_MYSQL_CONNECTED', 1);
        $mysqlVersion = mysql_get_server_info($link);
        define('SYSTEMTEST_MYSQL_SERV_VERSION_OK', (version_compare($mysqlVersion, $mysqlVersionNeeded) > 0));
        define('SYSTEMTEST_MYSQL_DB_ACCESS', mysql_select_db($dbBase, $link));
        if (!SYSTEMTEST_MYSQL_DB_ACCESS) {
            define('SYSTEMTEST_MYSQL_DB_ACCESS_ERROR', mysql_error());
        }
        mysql_close($link);
    } else {
        define('SYSTEMTEST_MYSQL_CONNECTED', 0);
        define('SYSTEMTEST_MYSQL_CONNECTED_ERROR', mysql_error());
    }
}
define('SYSTEMTEST_MYSQL', SYSTEMTEST_MYSQL_CONNECTED && SYSTEMTEST_MYSQL_SERV_VERSION_OK && SYSTEMTEST_MYSQL_DB_ACCESS);
define('SYSTEMTEST_ALL_OK', SYSTEMTEST_PHP && SYSTEMTEST_MYSQL && SYSTEMTEST_DISK && SYSTEMTEST_MAIN_HOST_EXISTS && SYSTEMTEST_SMTP_HOST_EXISTS);
?>
<TABLE border=0 ALIGN="CENTER" cellpadding=5 cellspacing=0 CLASS="border">
<TR ALIGN="center">
<TD CLASS="line small">
<?php echo $installer_lang['installation_soft']; ?>
</TD>
<TD CLASS="line small">
<?php echo $installer_lang['installation_param_title']; ?>
</TD>
<TD CLASS="line small">
<?php echo $installer_lang['installation_need_title']; ?>
</TD>
<TD CLASS="line small">
<?php echo $installer_lang['installation_cur_title']; ?>
</TD>
<TD CLASS="line small">
<?php echo $installer_lang['installation_res_title']; ?>
</TD>
</TR>
<TR>
<TD ROWSPAN="<?php echo (($is_win && !SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT)?'10':'6')?>" VALIGN="TOP" NOWRAP CLASS="line"><B>
<?php echo $installer_lang['installation_php_title']; ?>
</B></TD>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php_ver']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print $phpVersionNeeded; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print PHP_VERSION; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_VERSION_OK) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>
<?php /*
<tr>
<td VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php_reg_gl']; ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpRegisterGlobalsNeeded)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpRegisterGlobals)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php 
/*
if (SYSTEMTEST_PHP_REGISTER_GLOBALS) { ?>
<B class="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B class="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } 
* /
?>
</td>
</tr>
*/ ?>
<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php_ses_hand']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print $phpSessionSaveHandlerNeeded; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print $phpSessionSaveHandler; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_SESSION_SAVE_HANDLER) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php_ses_cook']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpSessionUseCookiesNeeded)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpSessionUseCookies)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_SESSION_USE_COOKIES) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php_ses_aut']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpSessionAutoStartNeeded)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpSessionAutoStart)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php  if (SYSTEMTEST_PHP_SESSION_AUTO_START) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>
<?php /*
<tr>
<td VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php_file_up']; ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpFileUploadsNeeded)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpFileUploads)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_FILE_UPLOADS) { ?>
<B class="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B class="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</td>
</tr>
*/?>
<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_mysql_lib_title']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpMysqlLibNeeded)) { ?>
not exists
<?php } else { ?>
exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT) { ?>
exists
<?php } else { ?>
not exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>
<?php /*
<tr>
<td VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_mysqli_lib_title']; ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpMysqliLibNeeded)) { ?>
not exists
<?php } else { ?>
exists
<?php } ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_MYSQLI_FUNC_PRESENT) { ?>
exists
<?php } else { ?>
not exists
<?php } ?>
</td>
<td ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_MYSQLI_FUNC_PRESENT) { ?>
<B class="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B class="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</td>
</tr>
*/ ?>
<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_short_tag_title']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (empty($phpShortOpenTagNeeded)) { ?>
off
<?php } else { ?>
on
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_SHORT_OPEN_TAG) { ?>
on
<?php } else { ?>
off
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_PHP_SHORT_OPEN_TAG) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>


<?php if ($is_win && !SYSTEMTEST_PHP_MYSQL_FUNC_PRESENT) { ?>
<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_extension_dir']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">exists</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_EXTENSION_DIR') && SYSTEMTEST_PHP_EXTENSION_DIR) { ?>
exists
<?php } else { ?>
not exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_EXTENSION_DIR') && SYSTEMTEST_PHP_EXTENSION_DIR) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_mysql_dll']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">exists</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_MYSQL_LIB') && SYSTEMTEST_PHP_MYSQL_LIB) { ?>
exists
<?php } else { ?>
not exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_MYSQL_LIB') && SYSTEMTEST_PHP_MYSQL_LIB) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_libmysql_dll']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">exists</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_SYS_MYSQL_LIB') && SYSTEMTEST_PHP_SYS_MYSQL_LIB) { ?>
exists
<?php } else { ?>
not exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_SYS_MYSQL_LIB') && SYSTEMTEST_PHP_SYS_MYSQL_LIB) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_php5']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">exists</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line"><?php if (defined('SYSTEMTEST_PHP_SYS_MYSQL_SUPPORT') && SYSTEMTEST_PHP_SYS_MYSQL_SUPPORT) { ?>
exists
<?php } else { ?>
not exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (defined('SYSTEMTEST_PHP_SYS_MYSQL_SUPPORT') && SYSTEMTEST_PHP_SYS_MYSQL_SUPPORT) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<?php } ?>
<TR>
<TD ROWSPAN="<?php echo ((SYSTEMTEST_MYSQL_CONNECTED)?'3':'1')?>" VALIGN="TOP" NOWRAP CLASS="line">
<B>
<?php echo $installer_lang['installation_mysql_block_title']; ?>
</B></TD>
<TD VALIGN="TOP" CLASS="line">
<?php echo $installer_lang['installation_mysql_conn']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">&nbsp;</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">&nbsp;</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_MYSQL_CONNECTED) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<SPAN CLASS="red">
<B><?php echo $installer_lang['installation_res_unsuccess']; ?></B>
<?php echo $installer_lang['installation_mysql_fail_text']; ?>
<?php print SYSTEMTEST_MYSQL_CONNECTED_ERROR; ?>
</SPAN>
<?php } ?>
</TD>
</TR>

<?php if (SYSTEMTEST_MYSQL_CONNECTED) { ?>
<TR>
<TD VALIGN="TOP" CLASS="line">
<?php echo $installer_lang['installation_mysql_ver']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print $mysqlVersionNeeded; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print isset($mysqlVersion) ? $mysqlVersion : ''; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_MYSQL_SERV_VERSION_OK) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" CLASS="line">
<?php echo $installer_lang['installation_mysql_acc']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">&nbsp;</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">&nbsp;</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_MYSQL_DB_ACCESS) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>
<?php } ?>
<TR>
<TD ROWSPAN="3" VALIGN="TOP" NOWRAP CLASS="line"><B>
<?php echo $installer_lang['installation_hdd_title']; ?>
</B></TD>
<TD VALIGN="TOP" CLASS="line">
<?php echo $installer_lang['installation_hdd_free']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print $diskFreeSpaceNeeded; ?>
<?php echo $installer_lang['installation_hdd_sp']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php print $diskFreeSpace; ?>
<?php echo $installer_lang['installation_hdd_sp']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_DISK_FREESIZE) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" NOWRAP CLASS="line">
<?php echo $installer_lang['installation_dir']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">/<?PHP print $INSTALL_DIR; ?></TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line"><?php if (is_dir (dirname ($STEP_DATA_FILE))) { ?>
/<?PHP print $INSTALL_DIR; ?>
<?php } else { ?>
not exists
<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (is_dir (dirname ($STEP_DATA_FILE))) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B><BR>
<SPAN CLASS="red">
Отсутствует папка "<?PHP print "http://".trim($_SERVER['SERVER_NAME'], '/')."<B>/".$INSTALL_DIR."</B>"; ?>". Зайдите на сайт по FTP, и создайте эту папку в корне сайта.
</SPAN>
<?php } ?>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" CLASS="line">
<?php echo $installer_lang['installation_write_title']; ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">yes</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_DISK_WRITE) { ?>
yes<?php } else { ?>
no<?php } ?>
</TD>
<TD ALIGN="CENTER" VALIGN="TOP" CLASS="line">
<?php if (SYSTEMTEST_DISK_WRITE) { ?>
<B CLASS="green">
<?php echo $installer_lang['installation_res_success']; ?>
</B>
<?php } else { ?>
<B CLASS="red">
<?php echo $installer_lang['installation_res_unsuccess']; ?>
</B><BR>
<SPAN CLASS="red">
Зайдите на сайт по FTP, и установите для папки "<?PHP print "http://".trim($_SERVER['SERVER_NAME'], '/')."<B>/".$INSTALL_DIR."</B>"; ?>" права доступа, равные <B>777</B>.
</SPAN>

<?php } ?>
</TD>
</TR>

<!--
<tr>
<td VALIGN="TOP" NOWRAP CLASS="line"><B>
<?php echo $installer_lang['installation_crons']; ?>
</B></td>
<td VALIGN="TOP" CLASS="line">
<?php echo $installer_lang['installation_is_crons']; ?>
</td>
<td COLSPAN="3" ALIGN="CENTER" VALIGN="TOP" CLASS="line">

<?php echo $installer_lang['installation_is_crons_text']; ?>
</td>
</tr>
-->
</TABLE>
<BR>
<SCRIPT>
function submitConfigForm() {
   document.forms.configForm.submit();
}
</SCRIPT>
<TABLE WIDTH="550" BORDER="0" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0">
<TR>
<TD ALIGN="CENTER">
<?php if (SYSTEMTEST_ALL_OK) { ?>

<FORM METHOD="POST" ACTION="?step=3" CLASS="form" NAME="configForm">
<INPUT TYPE="hidden" NAME="wininst" VALUE="<?php echo $wininst; ?>">
<INPUT TYPE="hidden" NAME="dbhost" VALUE="<?php print $dbHost;?>">
<INPUT TYPE="hidden" NAME="dbuser" VALUE="<?php print $dbUser;?>">
<INPUT TYPE="hidden" NAME="dbpassword" VALUE="<?php print $dbPassword;?>">
<INPUT TYPE="hidden" NAME="dbbase" VALUE="<?php print $dbBase;?>">
<?php if (!$wininst) { ?>
<INPUT TYPE="button" VALUE="     <?php echo $installer_lang['installation_but_next']; ?>     " onClick="Next();">
<? } ?>
</FORM>
<?php }  else { ?>

<SPAN CLASS="red">
<H3 CLASS="red"><?php echo $installer_lang['installation_unavailable']; ?></H3><BR>

<?php echo $installer_lang['installation_unavailable_text_s']; ?><BR>

<?php if (!SYSTEMTEST_MAIN_HOST_EXISTS) {?>
<B><?php echo $installer_lang['installation_unavailable_text_nogo']; ?></B><BR>
<?php echo $installer_lang['installation_un_desc_f']; ?>
<?php echo $mainHost; ?>
<?php echo $installer_lang['installation_un_desc_s']; ?>
<BR>
<?php } ?>


<?php if (defined ('SYSTEMTEST_SMTP_HOST_EXISTS') && !SYSTEMTEST_SMTP_HOST_EXISTS) {?>
<B><?php echo $installer_lang['installation_unavailable_text_nogo']; ?></B><BR>
<?php echo $installer_lang['installation_un_desc_t']; ?>
<?php echo $MailerSmtpHost; ?>
<?php echo $installer_lang['installation_un_desc_fo']; ?>
<?php echo $MailerSmtpPort; ?>
<?php echo $installer_lang['installation_un_desc_fi']; ?><BR>
<?php } ?>

</SPAN>

<FORM METHOD="POST" ACTION="?step=<?php echo ((int)$_GET['step']-1); ?>" CLASS="form" NAME="backForm">
<INPUT TYPE="hidden" NAME="wininst" VALUE="<?php echo $wininst; ?>">
<?php if (!$wininst) { ?><BR>
<INPUT TYPE="button" VALUE="     <?php echo $installer_lang['installation_but_back']; ?>     " onClick="Prev()">
<? } ?>
</FORM>

<?php } ?>





</TD>
</TR>
</TABLE>
</TD></TR></TABLE>
</TD></TR></TABLE>

<?php // ========================== STEP3 ==========================
}
else if ($_GET['step'] == '3') {
if (file_exists($STEP_DATA_FILE) && !isset($_POST['dbhost'])) {
   $tmpConfigXml = file_get_contents($STEP_DATA_FILE);
   $tmpConfigArr = $xmlParserObj->XmlUnpack($tmpConfigXml);
   if (is_array($tmpConfigArr) && !empty($tmpConfigArr)) {
      $_POST['dbhost'] = $tmpConfigArr['db_host'];
      $_POST['dbuser'] = $tmpConfigArr['db_user'];
      $_POST['dbpassword'] = $tmpConfigArr['db_password'];
      $_POST['dbbase'] = $tmpConfigArr['db_base'];
   }
}
$confParams = array('step'=>'3');
if (file_exists($STEP_DATA_FILE)) {
   $xmlParserObj->RewriteConfig($confParams, $STEP_DATA_FILE);
}
?>

<SCRIPT>
function submitConfigForm() {
   document.forms.configForm.submit();
}

</SCRIPT>

<?php

    if (isset($_POST['sa']) && $_POST['sa'] == '1') {
        $code = isset($_POST['license']) ? $_POST['license'] : '';
        eval (base64_decode ('JGNvZGUgPSBzdHJ0b2xvd2VyKCRjb2RlKTskdXNlcnMgPSAoJGNvZGVbNV0qMTAgKyAkY29kZVs4XSkqNTskYWxsb3dlZF9zeW1ib2xzID0gIjIzNDU2Nzg5YWJjZGVnaGttbnBxc3V2eHl6Ijskc3ltYm9sc19jb3VudCA9IHN0cmxlbiAoJGFsbG93ZWRfc3ltYm9scyk7JGlkID0gMDtmb3IgKCRpID0gMDsgJGkgPCA0OyAkaSArKykgeyRsZXR0ZXIgPSBzdHJwb3MgKCRhbGxvd2VkX3N5bWJvbHMsICRjb2RlIFskaV0pOyRsZXR0ZXIgPSAkc3ltYm9sc19jb3VudCAtICRsZXR0ZXIgLSAxOyRpZCArPSAkbGV0dGVyICogcG93ICgkc3ltYm9sc19jb3VudCwgJGkpO30kc3RyID0gInJ5Y2JrbWhiIjskc3RyX2xlbiA9IHN0cmxlbiAoJHN0cik7ZXZhbCAoYmFzZTY0X2RlY29kZSAoJ0pIVWdJRDBnWTJWcGJDQW9KSFZ6WlhKeklDOGdOU2s3SkdGc2JHOTNaV1JmYzNsdFltOXNjeUE5SUNJeU16UTFOamM0T1dGaVkyUmxaMmhyYlc1d2NYTjFkbmg1ZWlJN0pITjViV0p2YkhOZlkyOTFiblFnUFNCemRISnNaVzRnS0NSaGJHeHZkMlZrWDNONWJXSnZiSE1wT3lSelpYSnBZV3dnUFNBbkp6dG1iM0lnS0NScElEMGdNRHNnSkdrZ1BDQWtjM1J5WDJ4bGJqc2dKR2tnS3lzcElIdHBaaUFvSkdrZ0pTQXlJRDA5SURBcElIc2tiR1YwZEdWeUlEMGdjM1J5Y0c5eklDZ2tZV3hzYjNkbFpGOXplVzFpYjJ4ekxDQWtjM1J5V3lScFhTa2dLeUJ6ZEhKd2IzTWdLQ1JoYkd4dmQyVmtYM041YldKdmJITXNJQ1J6ZEhJZ1d5UnBLekZkS1R0OVpXeHpaU0I3Skd4bGRIUmxjaUE5SUhOMGNuQnZjeUFvSkdGc2JHOTNaV1JmYzNsdFltOXNjeXdnSkhOMGNsc2thVjBwSUNzZ2MzUnljRzl6SUNna1lXeHNiM2RsWkY5emVXMWliMnh6TENBa2MzUnlJRnNrYVMweFhTazdmU1JzWlhSMFpYSWdQU0FrYkdWMGRHVnlJQ1VnSkhONWJXSnZiSE5mWTI5MWJuUTdKR3hsZEhSbGNpQTlJQ1JzWlhSMFpYSWdYaUFrYVdRN0pHeGxkSFJsY2lBOUlDUnNaWFIwWlhJZ1hpQWtkVHNrYkdWMGRHVnlJQ3M5SUNScFpDQXJJQ1JzWlhSMFpYSWdQajRnSkdrZ0t5QWthVHNrYkdWMGRHVnlJRDBnSkd4bGRIUmxjaUErUGlBeU95UnNaWFIwWlhJZ1BTQWtiR1YwZEdWeUlGNGdKSE41YldKdmJITmZZMjkxYm5RN0pHeGxkSFJsY2lBcVBTQnpkSEp3YjNNZ0tDUmhiR3h2ZDJWa1gzTjViV0p2YkhNc0lDUnpkSElnV3lScFhTazdKR3hsZEhSbGNpQTlJQ1JzWlhSMFpYSWdKU0FrYzNsdFltOXNjMTlqYjNWdWREc2tiR1YwZEdWeUlEMGdKR0ZzYkc5M1pXUmZjM2x0WW05c2N5QmJKR3hsZEhSbGNsMDdKSE5sY21saGJDQXVQU0FrYkdWMGRHVnlPMzFsZG1Gc0lDaGlZWE5sTmpSZlpHVmpiMlJsSUNnblEybFNlbHBZU25CWlYzaG1ZbGRHTkZneWVHeGlhVUU1U1VSbk4wcEhOV3hrTVRsNldsaEtjRmxYZDJkUVUwSm9ZMjVLYUdWVFFXOUxWSE5yWXpKV2VXRlhSbk5ZTW5oc1ltbEJPVWxJVGpCamJYaHNZbWxCYjBwSVRteGpiV3hvWWtOck4xcHRPWGxKUTJkcllWTkJPVWxFUVRkSlExSndTVVIzWjBwSVRqQmpiRGx6V2xjME4wbERVbkJKUTNOeVMxTkNOMkZYV1dkTFExSndTVVIzWjBwSVRteGpiV3hvWWtZNWRGbFlhR1ppUjFaMVMxTkNOMHBITld4a01UbDZXbGhLY0ZsWGQyZFhlVkp3V0ZOQk9VbElUakJqYmtKMlkzbEJiMHBIUm5OaVJ6a3pXbGRTWm1NemJIUlpiVGx6WTNsM1owcElUbXhqYld4b1lrTkNZa3BIYkdSTFZIUTVXbGQ0ZWxwVFFqZEtSelZzWkRFNWVscFlTbkJaVjNkblYzbFNjRXBVYkdSSlEzTTVTVWhPTUdOdVFuWmplVUZ2U2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVYZG5Ta2hPYkdOdGJHaGlRMEppU2tkc1pFdFVkRGxtVjFwMlkyMVdhRmt5WjJkTFExSjFXbGhrWm1NeVZubGhWMFp6U1VkR2VrbERVbkJKUkRBclNVTlpaMHBIZUd4a1NGSnNZMmxyWjJWNVVuTmFXRkl3V2xoSloxQlRRV3RqTTJ4MFdXMDVjMk14T1dwaU0xWjFaRU5CZEVsRVJXZE1VMEZyWWtkV01HUkhWbmxKUTFWblNraE9OV0pYU25aaVNFNW1XVEk1TVdKdVVUZEtSM2hzWkVoU2JHTnBRVGxKUTFKb1lrZDRkbVF5Vm10WU0wNDFZbGRLZG1KSVRXZFhlVkp6V2xoU01GcFlTbVJQTXpGc1pHMUdjMGxEYUdsWldFNXNUbXBTWmxwSFZtcGlNbEpzU1VObmFWZHRNRFZsVm5CWVVtMXdhRkV3Um5aVGEyTXhZa2RSZUU5WWNHRlhSWEIzVjFaa00xb3hiRmxVVjJSTFVqSjBibFZHVVRCYU1IQklaVWQ0YTFOR1NuTlpNbXh5V2pKV05WVnVUbUZYUmtsM1YyeG9TbG94UWxSUlYzUm9WVEJHZUZOVlVrNU5SV3hFWXpKa2FVMHdjSEpUVlU1dVlUSktTRlpxUW10U01WbzFVekZPUW1SRmJFbFVha0pxWW10S01sa3piRUppTUhCSVVtNU9hVko2YTNwWGJHUlRXbTFOZW1KSVVscGlWR3g2V1ROc00xb3djRWhsUjNoclUwWktjMWt5YkhKYU1VSkZaREprVG1GdVRuSlphMlJYVFVkU1NGWnViRXBTUkVKdVUydGtOR0pIVWtsVmJYaHFZVlZHYzFOVlRsTmxiVlpZVFZkc2FVMXVhRFpYUkVwUFpHMVNXRTVVUWxCbFZrcDZWMnhvVTAxR2NGbFRWMlJSVlRCR2NsZFdaRFJqTWtsNldrZDRZVkpxYkRaYVZtTjRZVmRKZVdWSWNFcFNiazV5V1d0a1YwMUhVa2hXYm14WlZraFJOVk5yWXpGaVIxRjRUMWh3WVZkRmNIZFhWbVEwV20xTmVsVnViRXBTUkVKdVdWY3dOV05IU25CUlZ6bExaVmRPZWxOVlRsTmtWbkJaV2tkYWFrMXNXalZaVm1SSFl6QjBWV1JFUm1saWF6VnpXa1ZPUW1Jd2NFaE9WM2hyVFZSc05sZHNhRXRqUm14WVpETkNVR1ZXU1hkWGJHTjRaREZuZVdKSGRFcFNSRUp1VTJ0a2MyRXdPVFZWYm5CclUwVndiVmxXWkZKYU1VSlVVVmRzU21GdVRqSlRNbXhUWTBad1JXTXpSazFOYkhBeVdUSnNRbUl3Y0VoaE1tUlJWVEJHTTFRemJFSmhNa1pVVVZSb1NsSkdSVE5UVlU1VFkwVnNSR016U2t4Vk1Fa3pVMnRrTkdKSFVrbFZiWGhxWVZWRk5WTlZaR0ZqTWtsNVQxaHNTbEV5WkhaVGEyUnpZVEJzUkZaWFpHcFNlbXQ2VTFWT2JtRXlUWHBpU0ZKYVlsUnNlbGw2UlRWaGJVbDZWbTVXYTFFelpHNVRhMlJ5WTJzeFZHRXpRa3BSZW1odVdUQmpOVTB3YkVSYU1uUnFUVEo0TUZkWE1EVmpNazE0VDFkd2FVMHhXakZhUlU0eldqQndTR0V6UWt4V1NFNXlXV3RrVjAxSFVraFdibXhLVWtSQ2JsTnJhRTlPVjBwWVUyNWFhVk5GTlcxWFZFazFUVmRLZFZWWFpFMVZNRVp5V1d0a1YwMUhVa2hXYm14S1VYcENibFJXVW5waE1rcElWbXBDYTFJeFdqVlRWVkYzV2pCd1NGSnVUbWxTZW10NlYyeGtVMXB0VFhwaVNGSmFZbFJzZWxremJFTlphM0JJWlVkNGExTkdTbk5aTW5kM1RqQndTVlJxUW1waVJHeDNWMnRPUW1SV1FsUlJWM1JwVWpGWmQxcEZaRmRsVlRoNlRWZDRhMkpWV25wVFZVNXZZVlpzV1ZSdGVFOWhiRXB0VjJ0a1YyRnRTWGxWYlhoS1VUSmtjRlV5ZEd0ak1rVjNZa1ZXVGxJeVVreFZNRnBMWXpGc2MyRkZUbUZpVlZwWlZsWlNhMU14VGtaT1dFNWFUV3BHZWxsVlpFdFNSa1pWWWtWd1VrMVZiekpYYTFadlV6RndkRkpzYUZaWFJscExXVlpTUTJOR1VraE5WMFpxVFd0c05WUXhhSE5UYkVWNVdraGFWR0V5YUZkWGFrSjNWa1pHV1dGRk5WTlNWVm96VlRGV1RrNUdiM2ROVmxaU1YwVktTMVZZY0ZOaWJHdzJWR3hrYUZZd01UWldWelZ6VTJ4RmVWcElTbHBpVkVaWVZGUkdibVZzVW5SbFIzQnBWak5vZGxkWGRGcE9WMVowVld0c1ZGZEZOVXRWYTFaSFpXeE9WbFZyY0dwU1YzaEZWR3RrYTFNeFRrZFdiVFZVWWtVMVExcFZWWGhTUmtaWlZtdHdVazFIZDNkVk1XUnlUVmRXZEZWc2FGUmlia0p5VlRCV2MySnNUWGRVYkU1clZtNUNXbGRyWkdGaGF6RnpWMnBXV2xadFVraFpla1p1Wld4U2NWRnRjR2hYUjFKMVZrZDBUMDB4YjNkT1ZWSm9aVzFTVEZVd1ZURmpNV3Q1VFZoT2FGSXdjRVZWVmxKelUyeE9SazVJWkZwTmFsWlVXa2N4VTFkV1JuVmFSMFpZVWxkNGRWVjZRazlWTWxaelkwWnNWR0pyU21GV2FrNXJaREZTTmxOc1RtbFNia0l3V1d0b1YxbFdWWGRTYmxwVVZqTlJNRlV5ZUVaa01WcHlUMVphVGxKc2NIUldhMUpEWlcxR1ZtVkZVbEppYmtKeVZUQldkbVF4YkhGVGFsSnJZbFpHTlZadE5YTlVSa1Y0VTI1R1dtRnJjRlJaYTFZd1ZrWkdWV0pHUmxaTlJXOHlWMnRXYjFNd01VaFRXR3hzVTBad2NsUlhlR0ZPVmsxM1ZHeE9iR0pJUWxwVk1qVkRWMnhaZWxwSVpGUk5Wa28yVTFkc2NtTkZPVE5RVkRCTFNXbHJjRTkzUFQwbktTazcnKSk7'));
    } else {
        define('LICENSE_OK', false);
    }
?>



<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<FORM METHOD="POST"  name="configForm" <?php if (LICENSE_OK) { ?>action="?step=4"<?php } ?> CLASS="form">
<INPUT TYPE="hidden" NAME="wininst" VALUE="<?php echo $wininst; ?>">
<H3><?php echo $installer_lang['installation_license_in']; ?></H3><BR>




<?php foreach (array('dbhost', 'dbuser', 'dbpassword', 'dbbase') as $key) {?>
<INPUT TYPE="hidden" NAME="<?php print $key; ?>" VALUE="<?php print $_POST[$key]; ?>">
<?php } ?>

<?php if (LICENSE_OK) { ?>
<INPUT type='hidden' name='license' VALUE="<?php print $_POST['license']; ?>">
<?php } else { ?>
<DIV ID="license_row">
<?php echo $installer_lang['installation_license_intro']; ?>
<BR>
<BR>

                <INPUT TYPE="hidden" NAME="sa" VALUE="1">
                <INPUT NAME="license" TYPE="text" SIZE="40" MAXLENGTH="100">
<BR>
<BR>
</DIV>


<BR>
<?php } ?>



<?php if (LICENSE_OK==true) {?>



<SCRIPT>
    var moveBy = 2;
    function progressBar() {
        var prdiv = document.getElementById("prdiv");
        window.setInterval(moveState, 5);
    }
    function moveState() {
        var prdiv = document.getElementById("prdiv");
        var stdiv = document.getElementById("stdiv");
        var curPos = (stdiv.style.left)? parseInt(stdiv.style.left) : 0;
        if ((curPos + (stdiv.offsetWidth + moveBy)) > prdiv.offsetWidth) curPos = 0 - moveBy;
        stdiv.style.left = curPos+moveBy;
    }
	document.forms['configForm'].style.display = 'none';
        document.getElementById('install_progress').style.display = 'block';
        progressBar();
</SCRIPT>


<SCRIPT LANGUAGE="Javascript">
document.forms['configForm'].submit();
document.forms['configForm'].style.display = 'none';
</SCRIPT>

<?php } ?>


<?php if (LICENSE_OK) {} else { ?>
<?php if (isset($_POST['sa']) && $_POST['sa'] == '1') { ?>
<SPAN CLASS="red">
<H3 CLASS="red"><?php echo $installer_lang['installation_license_error']; ?></H3><BR>
<?php echo $installer_lang['installation_license_error_desc']; ?></SPAN><BR><BR>
<?php } ?>
<?php } ?>




<?php if (!$wininst) { ?>
<INPUT TYPE="button" VALUE="     <?php echo $installer_lang['installation_but_next']; ?>     " onClick="Next()">
<? } ?>

</FORM>

</TD></TR></TABLE>
</TD></TR></TABLE>











<?php // ========================== STEP4 ==========================
} else if ($_GET['step'] == '4') { ?>
<SCRIPT>
    var moveBy = 2;
    function progressBar() {
        var prdiv = document.getElementById("prdiv");
        window.setInterval(moveState, 5);
    }
    function moveState() {
        var prdiv = document.getElementById("prdiv");
        var stdiv = document.getElementById("stdiv");
        var curPos = (stdiv.style.left)? parseInt(stdiv.style.left) : 0;
        if ((curPos + (stdiv.offsetWidth + moveBy)) > prdiv.offsetWidth) curPos = 0 - moveBy;
        stdiv.style.left = curPos+moveBy;
    }
        document.getElementById('install_progress').style.display = 'block';
        progressBar();
</SCRIPT>

<?php
$dbHost         = $_POST['dbhost'];
$dbUser         = $_POST['dbuser'];
$dbPassword     = $_POST['dbpassword'];
$dbBase         = $_POST['dbbase'];
$permission_dirs = @$_POST['permission_dirs'];
$permission_files = @$_POST['permission_files'];

if (file_exists($STEP_DATA_FILE)) {
   $tmpConfigXml = file_get_contents($STEP_DATA_FILE);
   $tmpConfigArr = $xmlParserObj->XmlUnpack($tmpConfigXml);
   if (is_array($tmpConfigArr) && !empty($tmpConfigArr)) {
      if (!$dbHost) {
        $dbHost = $tmpConfigArr['db_host'];
        $dbUser = $tmpConfigArr['db_user'];
        $dbPassword = $tmpConfigArr['db_password'];
        $dbBase = $tmpConfigArr['db_base'];
      }
      if (!$permission_dirs) {
        $permission_dirs = $tmpConfigArr['permission_dirs'];
        $permission_files = $tmpConfigArr['permission_files'];
      }
      //$_POST['license'] = $tmpConfigArr['license'];
   }
}
$confParams = array('step'=>'4', 'license'=>$_POST['license']);
if (file_exists($STEP_DATA_FILE)) {
   $xmlParserObj->RewriteConfig($confParams, $STEP_DATA_FILE);
}

?>
<FORM name='bd' METHOD="POST" ACTION="?step=5">
<INPUT TYPE="hidden" NAME="wininst" VALUE="<?php echo $wininst; ?>">
<INPUT TYPE="hidden" NAME="dbhost" VALUE="<?php print $dbHost; ?>">
<INPUT TYPE="hidden" NAME="dbuser" VALUE="<?php print $dbUser; ?>">
<INPUT TYPE="hidden" NAME="dbpassword" VALUE="<?php print $dbPassword; ?>">
<INPUT TYPE="hidden" NAME="dbbase" VALUE="<?php print $dbBase; ?>">
<INPUT TYPE="hidden" NAME="license" VALUE="<?php print $_POST['license']; ?>">
<INPUT TYPE="hidden" NAME="unpack" VALUE="<?php print UNPACK_OK ? '1' : '0'; ?>">
<INPUT TYPE="hidden" NAME="unpackerrors" VALUE="<?php print ""; ?>">
<INPUT TYPE="hidden" NAME="dirsrights" VALUE="<?php print ERROR_ADDITIOANL_DIRS_RIGHTS ? '1' : '0'; ?>">
</FORM>
<?php

//exact same defines on step 5 to remove these
define ('INSTALL_PACKAGE_DIR', '');
define ('INSTALL_PACKAGE', INSTALL_PACKAGE_DIR.'dacons.pkg');

define ('ERROR_UNPACK_INT', 1);
define ('ERROR_UNPACK_HEX', 2);
define ('ERROR_WRITE_OUTPUT_FILE', 3);
define ('ERROR_FILE_NOT_EXISTS', 4);
define ('ERROR_READ_FILE', 5);
define ('ERROR_READ_PACKAGE_FILE', 6);
define ('ERROR_WRONG_FORMAT', 7);
define ('ERROR_CHECKSUM', 8);
define ('BUFFER_SIZE', 65536);
define ('PACKER_INT_FORMAT', 'N');
define ('PACKER_HEX_FORMAT', 'H');
define ('PACKER_PACKAGE_HEADER', 'IPIPacker');
define ('MD5_LENGTH', strlen(md5('')));
define ('CURRENT_FILE_RIGHTS', intval (strval ($permission_files), 8));   // 0644
define ('CURRENT_DIR_RIGHTS', intval (strval ($permission_dirs), 8));    // 0755

define ('FULL_DIR_RIGHTS', 0777);
/*
define('TOUCH_TEST_FILE', 'test.txt');
define('ATTACHES_DIR', 'dacons/attaches');
define('ATTACHES_PHOTOS_DIR', 'dacons/attaches/photos');
*/

function createDir ($path) {
	if (is_dir ($path)) return true;
	umask (0);
	global $doc_root;
	$path_arr = explode ('/', $path);
	$path_arr_count = count ($path_arr);
	$path = '';
	for ($i = 0; $i < $path_arr_count; ++$i) {
		$path .= $path_arr [$i].'/';
		if (!is_dir ($path)) {
			mkdir ($path);
			chmod ($path, CURRENT_DIR_RIGHTS);
		}
	}
	if (is_dir ($path)) return true;
	return false;
}

$path_array = array ();
$files_array = array ();

load_dump ($path_array, $files_array);

//umask (0);
foreach ($path_array as $key => $val) {
	// создаем директорию
    $dir = dirname ($val);
    //createDir ($INSTALL_DIR.$dir);
    mkdir ($INSTALL_DIR.$dir, 0777, true);
    chmod ($INSTALL_DIR.$dir, CURRENT_DIR_RIGHTS);
    $fp = fopen ($INSTALL_DIR.$val, 'w');
    $file_content = base64_decode ($files_array [$key]);
    fwrite ($fp, $file_content);
    fclose ($fp);
    chmod ($INSTALL_DIR.$val, CURRENT_FILE_RIGHTS);
    //chmod ($INSTALL_DIR.$val, 438);
}

$dirs = array ('conf', 'exportdata', 'logs', 'templates_c', 'patches', 'importdata', 'dumper/backup', 'uploads/tmp');

umask (0);
foreach ($dirs as $dir) {
	createDir ($INSTALL_DIR.$dir);
	chmod ($INSTALL_DIR.$dir, FULL_DIR_RIGHTS);
}

?>


<SCRIPT LANGUAGE="Javascript">
document.forms['bd'].submit();
</SCRIPT>






<?php // ========================== STEP5 ==========================
} else if ($_GET['step'] == '5') {
define ('INSTALL_PACKAGE_DIR', '');
?>

<? /*
<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<h3><?php echo $installer_lang['installation_wait_process']; ?></h3>
</TD></TR></TABLE>
</TD></TR></TABLE>
*/ ?>

<?php
error_reporting (E_ALL);
$confwrite1 = false;
$confwrite2 = false;
if (file_exists($STEP_DATA_FILE)) {
   $tmpConfigXml = file_get_contents($STEP_DATA_FILE);
   $tmpConfigArr = $xmlParserObj->XmlUnpack($tmpConfigXml);
   if (is_array($tmpConfigArr) && !empty($tmpConfigArr)) {
      $confParams = array(/*'MAIN_HOST'=>$tmpConfigArr['main_host'], */'MAIN_MAIL_FROM'=>$tmpConfigArr['dacons_mail_from'], 'MAIN_ADMIN_EMAIL'=>$tmpConfigArr['dacons_admin_email']);
      $confwrite1 = $xmlParserObj->RewriteConfig($confParams, dirname(__FILE__).'/'.$INSTALL_DIR.'dacons/-/config.xml');

      $MailerType = $tmpConfigArr['mailer_type'];
      $MailerSmtpHost = $tmpConfigArr['mailer_smtp_host'];
      $MailerSmtpPort = $tmpConfigArr['mailer_smtp_port'];
      $confParams = array(/*'SYSTEM_MAINSERVER'=>$tmpConfigArr['main_host'],*/
      'MAILER_TYPE'=>$MailerType, 'MAILER_SMTP_HOST'=>$MailerSmtpHost, 'MAILER_SMTP_PORT'=>$MailerSmtpPort, 'SYSTEM_DEFAULT_OWNER' => 'user', 'AUTHORIZATION' => 'sessions', 'SYSTEM_DEFAULT_LANGUAGE' => $cur_lang);
      $confwrite2 = $xmlParserObj->RewriteConfig($confParams, dirname(__FILE__).'/'.$INSTALL_DIR.'system/config.xml');
   }
}
/*
if (! file_exists (dirname(__FILE__).'/'.$INSTALL_DIR.'temp')) {
    mkdir (dirname(__FILE__).'/'.$INSTALL_DIR.'temp');
}
touch (dirname(__FILE__).'/'.$INSTALL_DIR.'temp/install_ok.php');
require_once(dirname(__FILE__).'/'.$INSTALL_DIR.'temp/install_ok.php');
if (INSTALL_OK) {
//    unlink($STEP_DATA_FILE);
}
*/

// закачиваем базу
mysql_connect ($tmpConfigArr ['db_host'], $tmpConfigArr ['db_user'], $tmpConfigArr ['db_password']);
mysql_query ('use '.$tmpConfigArr ['db_base']);

$errors_arr = array ();
$dump_file = $INSTALL_DIR.'dump.sql.'.$_lang_tmp;
if (file_exists ($dump_file)) {
$sql = file_get_contents ($dump_file);
$sql_arr = explode (";
", $sql);
foreach ($sql_arr as $query) {
	$query = trim ($query);
	if (! empty ($query)) {
		mysql_query ($query);
		$err =  mysql_error ();
		if(! empty ($err)) {
			echo $query."<br><b>$err</b><br>";
			$errors_arr [] = $err;
		}
	}
}
}
mysql_query ("update dacons_users set email = '".$tmpConfigArr ['dacons_admin_email']."' where username = 'admin'");

function add_single_user (){}

add_single_user ();

define ('INSTALL_FILL_DB', empty ($errors_arr));
define ('INSTALL_DB_ERRORS', join ("\n", $errors_arr));
define ('INSTALL_SQL_FILE', empty ($errors_arr));
define ('INSTALL_DATABASE_CONFIGURING', empty ($errors_arr));


$dirsrights = $_POST['dirsrights'];
$confwrite = false;
$config_content = file_get_contents ('conf/config_template.php');
if (empty ($tmpConfigArr ['is_saas']))  $tmpConfigArr ['is_saas'] = 'false';
$keys = array_keys ($tmpConfigArr);
foreach ($keys as & $key) $key = '{'.$key.'}';
$vals = array_values ($tmpConfigArr);
$config_content = str_replace ($keys, $vals, $config_content);


$fp = fopen ($INSTALL_DIR.'conf/config.php', 'wb');
fputs ($fp, $config_content);
fclose ($fp);
chmod ($INSTALL_DIR.'conf/config.php', 0777);
if (file_exists ($INSTALL_DIR.'conf/config.php') && file_get_contents ($INSTALL_DIR.'conf/config.php') == $config_content) $confwrite = true;

//require_once(dirname(__FILE__).'/'.$INSTALL_DIR.'temp/install_ok.php');

//$AR = EncodeAR($_POST['license']);
?>
<SCRIPT LANGUAGE="Javascript">
function copyUserInfo() {
    var userInfo = document.getElementById('ar_lic');
    var rangeObj = userInfo.createTextRange();
    rangeObj.execCommand("RemoveFormat");
    rangeObj.execCommand("Copy");
    return true;
}
</SCRIPT>

<TABLE HEIGHT="100%" BORDER="0" ALIGN="CENTER" CELLPADDING="20" CELLSPACING="0"><TR><TD ALIGN="CENTER">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD CLASS="white_bg">
<?php if (/*INSTALL_OK && */$dirsrights && $confwrite) {
touch(INSTALLED_OK_LOCKFILE);
?>
<SCRIPT language = "JavaScript">
document.getElementById('please_wait').style.display = 'none';
</SCRIPT>
<H3><?php echo $installer_lang['installation_results_suc_title']; ?></H3><BR>

<SPAN CLASS="red">
<?php /*echo $installer_lang['installation_results_suc_text_s']."<BR><BR>"; */?>
<?php echo $installer_lang['installation_results_passch_text']; ?><BR><BR>
<?PHP if ($INSTALL_DIR != '') { ?><?php echo str_replace ('{dir}', dirname (__FILE__).'/'.$INSTALL_DIR, $installer_lang['please_change_rights']); ?><BR><BR><?PHP } ?>
<?php /* echo $installer_lang['installation_results_ac_code']."<BR><BR>"; */ ?>
</SPAN>


<TABLE WIDTH="550" border=0 ALIGN="CENTER" cellpadding=5 cellspacing=0 CLASS="border">

<? /*
<TR>
<TD CLASS="line">
<?php echo $installer_lang['installation_results_code_text']; ?>
</TD>
<TD ALIGN="CENTER" CLASS="line">
<TEXTAREA ROWS="3" ID="ar_lic" STYLE="width:100%; font-weight:bold; font-size:16px; text-align:center; vertical-align:middle; ">
<?php include $INSTALL_DIR."conf/config.php"; 
$d =  (base64_encode (disk_total_space($_SERVER ['DOCUMENT_ROOT'])));
$r =  (base64_encode ($_SERVER ['DOCUMENT_ROOT']));
$activation_request = join ('.', array ($conf ['license'], $d, $r));
echo $activation_request; ?>
</TEXTAREA>
</TD>
</TR>
*/ ?>

<TR>
<TD CLASS="line">
<?php echo $installer_lang['installation_results_pass_text']; ?>
</TD>
<TD ALIGN="CENTER" CLASS="line"><H2>admin</H2></TD>
</TR>

<TR>
<TD CLASS="line">
<?php echo $installer_lang['installation_results_login_text']; ?>
</TD>
<TD ALIGN="CENTER" CLASS="line"><H2>123456</H2></TD>
</TR>

</TABLE>


<SCRIPT>
function submitConfigForm() {
   document.forms.configForm.submit();
}
</SCRIPT>

<BR>
<FORM METHOD="POST"  name="configForm" <?php if (/*INSTALL_OK && */$dirsrights && $confwrite) { ?>action="?step=6"<?php } ?> CLASS="form">
<?php if (!$wininst) { ?>
<INPUT NAME="Button" type=BUTTON VALUE="     <?php echo $installer_lang['installation_enter_hd']; ?>     " onClick="self.location = './<?php echo $INSTALL_DIR;?>';">
<? } ?>
</FORM>

<?php } ?>



<?php if (/*!INSTALL_OK || */!$dirsrights || !$confwrite) {
$count=1;?>

<H3 CLASS="red"><?php echo $installer_lang['installation_unavailable_step5']; ?></H3><BR>

<TABLE WIDTH="550" border=0 ALIGN="CENTER" cellpadding=5 cellspacing=0 CLASS="border">
<TR ALIGN="center">
<TD NOWRAP CLASS="line small">
<?php echo $installer_lang['installation_reults_op_title']; ?>
</TD>
<TD NOWRAP CLASS="line small">
<?php echo $installer_lang['installation_reults_res_title']; ?>
</TD>
</TR>
<TR>
<TD CLASS="line"><?php echo $installer_lang['installation_reults_cop']; ?></TD>
<TD ALIGN="CENTER" CLASS="line">
<?php if (INSTALL_UNPACK_RESULT) { ?>
<B CLASS="green"><?php echo $installer_lang['installation_res_success']; ?></B>
<?php } else { ?>
<B CLASS="red"><?php echo $installer_lang['installation_res_unsuccess']; ?></B>
<?php } ?>
</TD>
</TR>

<TR>
<TD CLASS="line"><?php echo $installer_lang['installation_results_musql']; ?></TD>
<TD ALIGN="CENTER" CLASS="line">
<?php if (INSTALL_DATABASE_CONFIGURING) { ?>
<B CLASS="green"><?php echo $installer_lang['installation_res_success']; ?></B>
<?php } else { ?>
<B CLASS="red"><?php echo $installer_lang['installation_res_unsuccess']; ?></B>
<?php } ?>
</TD>
</TR>


<TR>
<TD CLASS="line"><?php echo $installer_lang['installation_results_rights']; ?></TD>
<TD ALIGN="CENTER" CLASS="line">
<?php if ($INSTALL_DIR_RIGHTS && $dirsrights) { ?>
<B CLASS="green"><?php echo $installer_lang['installation_res_success']; ?></B>
<?php } else { ?>
<B CLASS="red"><?php echo $installer_lang['installation_res_unsuccess']; ?></B>
<?php } ?>
</TD>
</TR>

<?php if (INSTALL_DATABASE_CONFIGURING) { ?>
<TR>
<TD CLASS="line"><?php echo $installer_lang['installation_results_mysql_feel']; ?></TD>
<TD ALIGN="CENTER" CLASS="line">
<?php if (INSTALL_FILL_DB) { ?>
<B CLASS="green"><?php echo $installer_lang['installation_res_success']; ?></B>
<?php } else { ?>
<B CLASS="red"><?php echo $installer_lang['installation_res_unsuccess']; ?></B><BR>
<PRE><?php print INSTALL_DB_ERRORS; ?></PRE>
<?php } ?>
</TD>
</TR>
<?php } ?>

<TR>
<TD CLASS="line"><?php echo $installer_lang['installation_results_conf']; ?></TD>
<TD ALIGN="CENTER" CLASS="line">
<?php if ($confwrite1 && $confwrite2) { ?>
<B CLASS="green"><?php echo $installer_lang['installation_res_success']; ?></B>
<?php } else { ?>
<B CLASS="red"><?php echo $installer_lang['installation_res_unsuccess']; ?></B>
<?php } ?>
</TD>
</TR>

</TABLE>



<BR>
<SPAN CLASS="red">
<?php echo $installer_lang['installation_results_un_text']; ?><BR><BR>
<?php if (!$INSTALL_DIR_RIGHTS || !INSTALL_DATABASE_CONFIGURING || !$dirsrights) { ?>
<?php echo $count.'. '.$installer_lang['installation_results_un_text_rights']; $count++; ?><BR><BR>
<?php } ?>
<?php /* if (!INSTALL_SQL_FILE) { ?>
<?php echo $count.'. '.$installer_lang['installation_results_un_text_data']; $count++; ?><br><br>
<?php } else { ?>
<?php print $count.'. '.INSTALL_DB_ERRORS; $count++; ?><br><br>
<?php } */?>
<?PHP if (!$confwrite2 || !$confwrite1) {?>
<?php echo $count.'. '.$installer_lang['installation_results_un_text_conf']; $count++; ?><BR><BR>
<?php } ?>
</SPAN>
<?php } ?>





</TD></TR></TABLE>
</TD></TR></TABLE>
<?php } ?>
<?php } ?>
</div>


</CENTER>

</BODY>
</HTML>
<?php if ($_GET['step'] == '6') {  
session_destroy ();
?>
<SCRIPT>
SetStatus('done');
</SCRIPT>
<?php } ?>
<?PHP 

} else if ($_REQUEST['image']=="body_back.png") { 
Header("Content-type: image/png"); 
print base64_decode('
iVBORw0KGgoAAAANSUhEUgAAAAMAAAL6CAMAAADE9Bx1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYBQTFRFcOsVRsgNaOQULrQJDpoDFqEEEZwDGKIFa+YUIqoHLLMIXtwSXNoSUNAPWtgREp0EUtIQOr4LTs4POLwLJKwHhv0aRMYNZOETevMXMLYJYd4SG6QFIKkGiP4aFJ4ETM0PWNcRVdQQQsUNScoOPcAMhvwZDJgCNrsKM7gKP8IMbukVbegVKrAIJq4HZuITbOcUHqcGNLkKQcQMQMMMHaYGKLAIJ64HhfwZhPsZf/cYefIXfvYYEJsDg/oZgPgYHKUFh/4adO4Wc+0WePEXgfkZgvkZcuwWffUYd/AXS8wOV9YRYt8TVtUQSssONboKY+ATe/QXZ+MUH6gGde8WKK8IFaAEK7IIYN0Sb+oVfPUYdu8WMbcJaeUUIakGTc4PJa0HPsEMZeITVNMQR8kOWdgRQ8YNN7wLfPQYgvoZGaMFO78LPMALd/EXDZkDgfgYcesWXNoRdvAWffYYg/sZZ+QUgPcYT88PdO0WW9kRgfgZXdsSL7UJUdEPUtEQde4Wcu0Wt/03+QAAAhlJREFUeNqkw+lTaWEcAOCTJCFE2SpEItmj0qKixVq2VLKvbdopKv71O+PDO/fM+b0H9z4zD7GyskI0Go2RM5nMke/u7o6UxWINXSAQDFWpVP7Xi4uLkU9MTAw8OTk58N3dHe35+Xna+/v7AzudTmybzUY7Ho/TXlhYQLPZLOnU1NQ/n52dxc7n89hmsxnd2NggTSaT2C6XizCZTENPpVK0ORwO9vj4OPj7+xtbLpeDb25usA0GA9hut2OfnZ2B9Xo9uFaroWKxmHJmZmbo9/f34IeHB3R5eRktFArg1dVV8Pr6OtjhcIA1Gg24Wq2iEomEdGxsbOjlchlbq9WCI5EIOBAIUKpUKuxcLoeKRCK01WqBp6enwT8/P5S/v7+EUCgEl0ol8NLSEjgcDoODwSBYrVaDK5UKyufz0a+vL/DLywvK4/FIO50OmMvlgi8vL7EVCgU4FAqBz8/PsaVSKbhYLKIWi4U0FouBPz4+CAaDAc5kMthsNhtstVqx19bWsI1GI/bV1RX2356fn0lPTk6we70e4fV6wZ+fn8Th4SG42+0SiUSCMp1Oo6+vr6jf76d8fHzs9/l84O3tbdoymYx2NBqlrNfr6PX1Nenp6Snl29tb/87ODrbb7abdbDYJj8eD/fT01N9ut4mjoyPK4+NjytvbW3Rvbw/7/f29f2tra+DNzc2h6nS6/rm5uZEfHByAFxcXB/0jwAD1FfKvqg2+DgAAAABJRU5ErkJggg==
');

} else if ($_REQUEST['image']=="logo_reg.png") { 
Header("Content-type: image/png"); 
print base64_decode('
iVBORw0KGgoAAAANSUhEUgAAAG4AAACECAMAAABGWu4tAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAYBQTFRFa8JiXr5RLaodUrlEccVoMqsk1e7SWbtPyunG5/XlI6UTO7ArueK0E50EYb5X7/ntTbZArN2mvuW5jdGFeshyx+jEGqEKs+Cu9PvzJqUZacJeVblKhMx9SbQ9ecluz+vM3vHcOq0umtWSxOfB3PHZR7M6TLY/KqkXkNGJ8fnwodqYnteYH6IRq9ylqd2hZ8FbHaQJNqwqwua+2/DY0e3N+v35gs147PfqJqgTRrU2MKwfsd+sIKUOQrMyKqcetuGyldSNndaXFp4JLaggHKEOFZ8EF6EEGqQFG6UFEp0DEJwDF6EFDpkDFJ4EFqEEGqMFDJgCEZ0DGaIF/P78QrE29/z2pNub6fbnGZ8Mrt6oQLMu5PTipNqek9SJ2fDW4vPgYcBTk9KMgct6PrAwTrhBGKAHp9uhS7c8dcdql9SRoNiZ4/Thh85/qdyjFJ0GmNaPFaAEG6QFD5oDFqAEGaMFFJ8EEp0ED5sDEZwDHKUFGKIFE54EEJsDDpoDDZkD////KYQWQAAABCVJREFUeNrsmflbEkEYgFdBEDBTEwRvLRUTDxRvPBLxyIwSvK9SKzMzDCmkY/710JxvhpkVdXeYHnv2/UX3+4Z52d2ZnfkW5ZVUlN9SMXSGztAZOsG6F1KRrfslFUNn6AzdP9B9lYqhE6n7LhVDd491P6Vi6AydTp11dBehh05vjWp2alyr7rkKJ+Y+hLHVevgGHZ3PtaGmCzkRTbSqhmlwjKJNwnR+G2JprPSR/FRzJjKhUZdiKRpEKrifNV3l/Y8vAy0pLXA6XyO6Bmdti6eptPPqqFeM7jO6JWUidD437m51/ahk93pb8ZqQs9v721uf9e+N3FtVtwV8Yi7m2uW4XIfvflLdoGLr86TE6FLdF8N8io7UVbG29emUKF3KiRrY+xL62E7JlpWUVpTXHHWr43zQZ8YTZLXW81ozyjzP+LwqRUrH0aS57GReB8q8VGTrvknF0N1j3QOpKD+k8q911aWx2HTmb1Gs1ezn25vNdbGY7+I/eywWM5fq1ZVQj/59rrkneyH67NF9dqSzT3xza9buzKr/YlLfv4NvvkWv6H4RQ4Vs/PicfZnYKnxCRuZEjlv3ltjKXZpG5iILdBl1samQm1zoRU3wukooDLjUKNi8ixp1SZYCuDlsphRsj5Ia4XUHuM/3TCIEtYo3KU7nuOYUXFD1NScF6opwr5XZ8WYYJUmROpjn2SkFZkBSqM6O++2mo639uK5z6dKFObCugIr58TCx2MN6yKGzkpDdgt9DhML50pkg8g6vSu374bzpWiGCB2W/KaxXF+cAHQ4c4kh1XC+30JmiV4H6uASdA1eS3rgEXRtebsvjInQJDnhxcnEAT8peV0IAN+nKYXonJOgG8PQuTEjQwYJ6kJCga4GNV4ko3UsO0I1QLzYHXgohh67GQu1h+4fF6GY4YCeWVQ7sDs0IIIeOoUquDtVL0EVJEdI/JkC3wJGlG1jYhv+f2GcWdHKD7ihzTArMzoX86kpcmfMJBuD4ULcuzUFsDcHLAJnuy/tpfeTS2UauImPwMNsJ5k3XPgYhqIrQVt503VRsklTQ+dIdULFIMbxucEjQpQuhuLP0SNClYfuHjmTo0sdw+8w6dEssQagRmEQFzL7hJa0oZyxDUHAxCXL7bIVnGuF1UCx3s5k35Ne0HmE6eBVwyKW6yG9OwnQfcJfH/HXeBN+2KB1csi986xpqbRekq4fNiUrzZrLMF2jSRVjg8WiJ8ATJ9mz5Q+Tu8DqYXm619mRtQO3DGnSzLGTr7JhVYZ34Bjdm7wqnayPdVau0nxsh7zSRzaFbR12tp6qfGKD2MrYNvTqyz0Obqp84p0uHh8N31J0yNKKdQNfKykogEEWmUzVMGUvAuXLZxu1Wb3MdrK5niDpoU/9MVnhIly7PyNbNSeU/151LxdAZulvyR4ABAIjB2F4CUloGAAAAAElFTkSuQmCC
');

}
// --> ?>
