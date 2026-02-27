<?php

namespace App\Exceptions;

use Exception;

class RakutenApiException extends Exception
{
    /**
     * Get the exception's context information.
     *
     * @return string 例外のコンテキスト情報
     */
    public function context(): string
    {
        return match($this->getCode()) {
            400 => 'エラーが発生しました。',
            404 => 'ホテルが見つかりませんでした。',
            429 => 'エラーが発生しました。時間を置いて再度お試しください。',
            default => 'サービスが利用できません。',
        };
    }
}