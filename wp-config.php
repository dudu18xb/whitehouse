<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'whitehousewb');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'p+fm?}<5>vYD+6_Sk^o,kdogKZkS=Inp_&TwG6:z}PABh|=cnMV:ULE,<Ff0:@?)');
define('SECURE_AUTH_KEY',  'nf>z]W_2.QRsUS]:{[*~1zDB&}RNnYlZLD4bF/0yO4&26/axvwsw./s^1hqXz0//');
define('LOGGED_IN_KEY',    '~?:-`*hCxMAZzYLe<sKJa,{00n%Fp}J{Me$Y@B-{5_6x Bq!%kfY|,pa)BJ:cdnR');
define('NONCE_KEY',        '?YUi5/UI~2m/>Vd[4}*#fo%,eIcp;pk|Z]6Gu^^zrBOFR TzXUG]M2@?7S$O.^e[');
define('AUTH_SALT',        '7}-aZ.(::5TDJ{H)R4>}RKr,[eul{+yG9FkC6?#p^Gj.?sVbeyAYvkg2y:a1 yn^');
define('SECURE_AUTH_SALT', 'Tmv|>^HsPS^:<BmSk5[d||v~0;E^*l=75u$wZM,WcL}YXsXCb`dKP~x;q!(NpP}J');
define('LOGGED_IN_SALT',   ';9;a^%(C@?~lxLNB]6J&J[h?9:8!CKel(XsdZLyq$:%=tnJ2Y=Z HX&#fF.YY]bE');
define('NONCE_SALT',       '%8EoU#f.b] .+w8i3hfEhVw48`0<k)HOW/>b8eZ-IFhOq%xjFKp<B%3&}PqS.UQD');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
