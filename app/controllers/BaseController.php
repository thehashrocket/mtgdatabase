<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

    public function __construct() {

        $userGuild = 0;
        if( Auth::check() ){
            $loggedInUser = Auth::user();
            $userGuild = $loggedInUser->guild;
        }

        View::share( 'today', date( 'YmdH' ) );

        View::share( 'currentGuild', $this->checkGuildChange( $userGuild ) );
        View::share( 'guildsList', $this->queryGuild() );

    }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    /**
     * Set the guild change
     */
    public function checkGuildChange( $userGuild )
    {
        $return = ( $userGuild != 0 ) ? $userGuild : Config::get( "mtg.default_guild" );
        return $return;
    }

    /**
     * Get all the guilds from the guilds table
     */
    public function queryGuild()
    {
        $guilds = array();
        $guildQuery = Guilds::all();
        foreach( $guildQuery as $id => $data ){
            $guilds[ $data->id ] = $data->name;
        }
        return $guilds;
    }

    /**
     *
     */
    public function paginateMe( $db_data, $perPage )
    {
        $db_data = $db_data->paginate( $perPage );
        $db_data->appends( array( 'perPage' => $perPage ) )->links();

        return $db_data;
    }

    /**
     *
     */
    static public function cardCost( $costs )
    {
        $return = "";
        $costs = json_decode( $costs );

        foreach( $costs as $cost ){
            $return .= '<span class="card-cost ' . $cost . '"></span>';
        }

        return $return;
    }

    /**
     *
     */
    static public function checkCosts( $content )
    {
        $patterns = Config::get( 'mtg.short_codes_array' );
        $replacments = Config::get( 'mtg.short_codes_replace_array' );

        return preg_replace( $patterns, $replacments, $content );
    }

}