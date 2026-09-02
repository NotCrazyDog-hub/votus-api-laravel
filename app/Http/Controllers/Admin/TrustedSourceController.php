<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedSource;
use Illuminate\Http\Request;

class TrustedSourceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'base_url' => [
                'required',
                'url',
                'max:255',
            ],
        ]);

        $baseUrl = rtrim(
            $validated['base_url'],
            '/'
        ) . '/';

        $host = parse_url(
            $baseUrl,
            PHP_URL_HOST
        );

        if (!$host) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'A URL informada é inválida.'
                );
        }

        $domain = preg_replace(
            '/^www\./',
            '',
            strtolower($host)
        );

        TrustedSource::create([
            'name' => $validated['name'],
            'domain' => $domain,
            'base_url' => $baseUrl,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.explanations.index')
            ->with(
                'success',
                'Fonte confiável cadastrada.'
            );
    }

    public function update(
        Request $request,
        TrustedSource $trustedSource
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'domain' => [
                'required',
                'string',
                'max:255',
            ],

            'is_active' => [
                'nullable',
                'boolean'
            ],
        ]);

        $trustedSource->update([
            'name' => $validated['name'],

            'domain' => $this->normalizeDomain(
                $validated['domain']
            ),

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.explanations.index')
            ->with(
                'success',
                'Fonte atualizada.'
            );
    }


    public function destroy(
        TrustedSource $trustedSource
    ) {
        $trustedSource->delete();

        return redirect()
            ->route('admin.explanations.index')
            ->with(
                'success',
                'Fonte removida.'
            );
    }


    private function normalizeDomain(
        string $domain
    ): string {
        $domain = trim(strtolower($domain));

        // Permite que o administrador cole uma URL inteira
        if (
            str_starts_with($domain, 'http://') ||
            str_starts_with($domain, 'https://')
        ) {
            $host = parse_url(
                $domain,
                PHP_URL_HOST
            );

            if ($host) {
                $domain = $host;
            }
        }

        return preg_replace(
            '/^www\./',
            '',
            $domain
        );
    }
}