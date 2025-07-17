<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TwilioTemplate;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class TwilioController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    /**
     * Fetch template content via AJAX
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchTemplate(Request $request): JsonResponse
    {
        try {
            $templateSid = $request->input('template_sid');

            if (empty($templateSid)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Template SID is required'
                ], 400);
            }

            $template = $this->twilioService->fetchTemplate($templateSid);

            return response()->json([
                'success' => true,
                'data' => [
                    'sid' => $template->sid,
                    'friendly_name' => $template->friendlyName,
                    'types' => $template->types,
                    'languages' => $template->languages,
                    'date_created' => $template->dateCreated,
                    'body' => $template->body,
                    'variables' => $template->variables
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Save broadcast messages
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function saveBroadcast(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'birthday_template_sid' => 'nullable|string',
                'birthday_message' => 'nullable|string',
                'idul_fitri_template_sid' => 'nullable|string',
                'idul_fitri_message' => 'nullable|string',
                'christmas_template_sid' => 'nullable|string',
                'christmas_message' => 'nullable|string',
            ]);

            $twilioTemplate = TwilioTemplate::firstOrCreate();
            $twilioTemplate->update([
                'templates->birthday_sid' => $validated['birthday_template_sid'],
                'templates->idul_fitri_sid' => $validated['idul_fitri_template_sid'],
                'templates->christmas_sid' => $validated['christmas_template_sid'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Broadcast messages saved successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
