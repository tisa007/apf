<?php
/**
 *           File:  Adapter.php
 *           Path:  ./A/Auth
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2011-08-15
 */
namespace A\Auth;

interface Adapter
{
    /**
     * authenticate
     *
     * @return A\Auth\Outcome
     */
    public function authenticate();
}
// End of file : Adapter.php
