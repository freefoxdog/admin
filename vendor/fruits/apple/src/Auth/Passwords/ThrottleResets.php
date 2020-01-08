<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/3/19
 * Time: 19:44
 */

namespace Fruits\Apple\Auth\Passwords;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;

trait ThrottleResets
{

    protected function hasTooManyResetAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts()
        );
    }

    public function attempts(Request $request)
    {
        return $this->limiter()->attempts($this->throttleKey($request));
    }
    protected function incrementResetAttempts(Request $request)
    {

        $this->limiter()->hit(
            $this->throttleKey($request), $this->decayMinutes()
        );
    }
    public function residue(Request $request)
    {

        $num = $this->attempts($request);

        $max = $this->maxAttempts();
        return  (int)$max - (int)$num;
    }
    protected function throttleKey(Request $request)
    {
        return 'throttleresets:'.Str::lower($request->input($this->username()));
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }
}