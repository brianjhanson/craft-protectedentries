<?php
/**
 * Protected Entries plugin for Craft CMS 3.x
 *
 * Require a password to access certain entries
 *
 * @link      https://brianhanson.net
 * @copyright Copyright (c) 2020 Brian Hanson
 */

namespace brianjhanson\protectedentries\controllers;

use brianjhanson\protectedentries\ProtectedEntries;
use Craft;
use craft\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Cookie;

/**
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 */
class AuthController extends Controller
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['authorize'];

    /**
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionAuthorize()
    {
        $requestService = Craft::$app->request;
        $this->requirePostRequest();

        $userPassword = $requestService->getRequiredParam('password');

        if (!ProtectedEntries::getInstance()->auth->authorize($userPassword)) {
            return null;
        }

        $cookie = new Cookie(Craft::cookieConfig([
            'name' => 'protectedEntries',
            'value' => $requestService->csrfToken,
            'expire' => time() + 3600
        ]));

        Craft::$app->response->getCookies()->add($cookie);
        return $this->redirectToPostedUrl();
    }
}
