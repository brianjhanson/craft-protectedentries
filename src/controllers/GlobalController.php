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

use brianjhanson\protectedentries\models\GlobalSettings;
use brianjhanson\protectedentries\ProtectedEntries;
use Craft;
use craft\web\Controller;
use yii\web\BadRequestHttpException;

/**
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 */
class GlobalController extends Controller
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = false;

    /**
     * Render the settings page.
     *
     * We're not using Craft's stock settings for this because we want it to be
     * available even when `allowAdminChanges` is off.
     */
    public function actionRender()
    {
        $settings = ProtectedEntries::getInstance()->global->get();

        return $this->renderTemplate('protected-entries', [
            'settings' => $settings
        ]);
    }

    /**
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionSave()
    {
        $requestService = Craft::$app->request;
        $this->requirePostRequest();

        $password = $requestService->getRequiredParam('password');

        $settings = new GlobalSettings();
        $settings->password = $password;

        if (!ProtectedEntries::getInstance()->global->save($settings)) {
            Craft::$app->urlManager->setRouteParams([
                'settings' => $settings
            ]);

            $this->setFailFlash('Failed to save settings.');
            return null;
        }

        $this->setSuccessFlash('Settings saved.');
        return null;
    }
}
