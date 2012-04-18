<?php 
/**
 * Innomatic
 *
 * LICENSE 
 * 
 * This source file is subject to the new BSD license that is bundled 
 * with this package in the file LICENSE.
 *
 * @copyright  1999-2012 Innoteam S.r.l.
 * @license    http://www.innomatic.org/license/   BSD License
 * @link       http://www.innomatic.org
 * @since      Class available since Release 5.0
*/

require_once('innomatic/webapp/WebAppHandler.php');
require_once('innomatic/webapp/WebAppProcessor.php');

/**
 * @since 1.0
 * @author Alex Pagnoni <alex.pagnoni@innoteam.it>
 * @copyright Copyright 2012 Innoteam S.r.l.
 */
class PhpWebAppHandler extends WebAppHandler
{
    public function init()
    {
    }

    public function doGet(WebAppRequest $req, WebAppResponse $res)
    {
        $resource = substr(
            WebAppContainer::instance(
                'webappcontainer'
            )->getCurrentWebApp()->getHome(), 0, -1
        ) . $req->getPathInfo();

        // make sure that this path exists on disk
        if (
            $req->getPathInfo() == '/index'
            or !file_exists($resource . '.php')
            or is_dir($resource)
        ) {
            $res->sendError(
                WebAppResponse::SC_NOT_FOUND,
                $req->getRequestURI()
            );
            return;
        }

        include($resource.'.php');
    }

    public function doPost(WebAppRequest $req, WebAppResponse $res)
    {
        $this->doGet($req, $res);
    }

    public function destroy()
    {
    }

    protected function getRelativePath(WebAppRequest $request)
    {
        $result = $request->getPathInfo();
        require_once('innomatic/io/filesystem/DirectoryUtils.php');
        return DirectoryUtils::normalize(strlen($result) ? $result : '/');
    }
}
