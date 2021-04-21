<?php

namespace api\tests\functional\v1\currency;

use api\tests\functional\v1\currency\fixtures\CurrencyFixture;
use api\tests\functional\v1\currency\fixtures\UserFixture;
use api\tests\FunctionalTester;

class CurrencyCest
{
    public function _fixtures()
    {
        return [
            UserFixture::class,
            CurrencyFixture::class,
        ];
    }

    public function bearerAuthorization(FunctionalTester $I)
    {
        $I->wantTo('See code 401 (Unauthorized)');
        $I->sendGet('v1/currencies');
        $I->seeResponseCodeIs(401);
    }

    public function currencyList(FunctionalTester $I)
    {
        $I->wantTo('See currency list');
        $I->amBearerAuthenticated('qwertyuii');
        $I->sendGet('v1/currencies');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('0.id');
        $I->seeResponseJsonMatchesJsonPath('0.name');
        $I->seeResponseJsonMatchesJsonPath('0.rate');
    }

    public function certainCurrency(FunctionalTester $I)
    {
        $I->wantTo('See certain currency');
        $I->amBearerAuthenticated('qwertyuii');
        $I->sendGet('v1/currency/USD');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->dontSeeResponseJsonMatchesJsonPath('id');
        $I->dontSeeResponseJsonMatchesJsonPath('name');
        $I->seeResponseJsonMatchesJsonPath('rate');
    }
}

