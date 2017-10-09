<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-09-30 16:36
 */
namespace Notadd\Foundation\Extension\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Foundation\Validation\Rule;

/**
 * Class ExtensionsController.
 */
class ExtensionsController extends Controller
{
    /**
     * @var bool
     */
    protected $onlyValues = true;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function install()
    {
        list($identification) = $this->validate($this->request, [
            'identification' => Rule::required(),
        ], [
            'identification.required' => '拓展标识必须填写',
        ]);
        if (!$this->extension->has($identification)) {
            return $this->response->json([
                'message' => '拓展不存在！',
            ])->setStatusCode(500);
        }
        $key = 'extension.' . $identification . '.require.install';
        $this->setting->set($key, true);
        $this->redis->flushall();

        return $this->response->json([
            'message' => '添加到待安装列表成功!',
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        return $this->response->json([
            'data'    => $this->extension->repository()->toArray(),
            'message' => '获取插件列表成功！',
        ]);
    }
}