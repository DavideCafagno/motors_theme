<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni del database
 * * Chiavi segrete
 * * Prefisso della tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'motors_theme' );

/** Nome utente del database */
define( 'DB_USER', 'root' );

/** Password del database */
define( 'DB_PASSWORD', 'root' );

/** Hostname del database */
define( 'DB_HOST', 'localhost' );

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di collazione del database. Da non modificare se non si ha idea di cosa sia. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chiavi univoche di autenticazione e di sicurezza.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tutti i cookie esistenti.
 * Ciò forzerà tutti gli utenti a effettuare nuovamente l'accesso.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'msw&;5L03>?!`eI_Y;<Gk4,j{u.n/|@eGq<y8b^B.Ev,[MJ6#W|#H,CHG~8?vmPK' );
define( 'SECURE_AUTH_KEY',  '|oq&3DoBXwm:I/3V)VkPi<oF*~&8T:}4tG~olkQ}|x4X5#-DZ_~9XS$-/hfypd&x' );
define( 'LOGGED_IN_KEY',    'dfBct*enr:im+r)e|wZtT+:R#DSxqkw$vpQJp%K`Qx9@`,&;^[I2-Aypl6s<q*<[' );
define( 'NONCE_KEY',        'J79!vceaFF_~`Nue-Mv|lW%3-8*|Rz8NN6T;Xp;tdU&7#u$EXrQ929blZYO?9.eL' );
define( 'AUTH_SALT',        'QBb(v#TMdH[I)h0){Rir@:?b6=l*H`CgH%-$>!qLq;E/5PRHkLAp)!20Lq8oh*vH' );
define( 'SECURE_AUTH_SALT', '[jvfttZdIBbgeX-8h|Z3Y*Z3.nHcG#j+2&6C/5r6,`w/9dfle*7+z6>K1C[-hEZb' );
define( 'LOGGED_IN_SALT',   'B;`b1FC&XkoQ0~,UQkrQ D4S<EyC14TglLM?/=Q,ww7p|CEqoa*qmcOL{qMG1tKb' );
define( 'NONCE_SALT',       '>6_0!}#<9ocZEJRMM(m_ Ro%#NO`JACmM[c@?#XO1yf5eME(k99};KlcfaRC-!*^' );

/**#@-*/

/**
 * Prefisso tabella del database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco. Solo numeri, lettere e trattini bassi!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Aggiungere qualsiasi valore personalizzato tra questa riga e la riga "Finito, interrompere le modifiche". */



/* Finito, interrompere le modifiche! Buona pubblicazione. */

/** Path assoluto alla directory di WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Imposta le variabili di WordPress ed include i file. */
require_once ABSPATH . 'wp-settings.php';
