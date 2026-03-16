<x-app-layout>
<x-slot name="header">
    <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--color-gray-800);">
        Shared With Me
    </h2>
</x-slot>

<div style="padding-top: 3rem; padding-bottom: 3rem;">
    <div class="container">
        <!-- Files Table -->
        <div class="card">
            <div class="card-header">
                <h3 style="font-size: 1.125rem; font-weight: 500; color: var(--color-gray-900);">Files Shared With You</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                @if ($sharedFiles->isEmpty())
                    <div style="text-align: center; padding: 3rem 0;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 5rem; height: 5rem; background-color: var(--color-gray-100); border-radius: var(--radius-full); margin-bottom: 1rem;">
                            <svg style="width: 2.5rem; height: 2.5rem; color: var(--color-gray-400);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 style="font-size: 0.875rem; font-weight: 500; color: var(--color-gray-900);">Nothing Shared Yet</h3>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: var(--color-gray-500);">When other users share files with you, they will securely appear here.</p>
                    </div>
                @else
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; min-width: 100%; border-collapse: collapse; text-align: left;">
                            <thead style="background-color: var(--color-gray-50); border-bottom: 1px solid var(--color-gray-200);">
                                <tr>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Document</th>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Shared By</th>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Size</th>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: var(--color-white);">
                                @foreach ($sharedFiles as $file)
                                    <tr style="border-bottom: 1px solid var(--color-gray-200); transition: background-color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-gray-50)'" onmouseout="this.style.backgroundColor='transparent'">
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                                            <div style="display: flex; align-items: center;">
                                                <div style="flex-shrink: 0; width: 2.5rem; height: 2.5rem;">
                                                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: var(--radius-lg); background-color: var(--color-primary-50); color: var(--color-primary-600);">
                                                        <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div style="margin-left: 1rem;">
                                                    <div style="font-size: 0.875rem; font-weight: 600; color: var(--color-gray-900); max-width: 16rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $file->file_name }}">{{ $file->file_name }}</div>
                                                    <div style="font-size: 0.625rem; color: var(--color-gray-400); font-family: monospace; text-transform: uppercase; letter-spacing: -0.05em;">Shared {{ $file->pivot->created_at ? $file->pivot->created_at->format('M d, Y') : $file->created_at->format('M d, Y') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                                            <div style="font-size: 0.875rem; color: var(--color-gray-900); font-weight: 500;">{{ $file->user->name }}</div>
                                            <div style="font-size: 0.75rem; color: var(--color-gray-500);">{{ $file->user->email }}</div>
                                        </td>
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: var(--color-gray-600); font-weight: 500;">
                                            {{ number_format($file->file_size / 1024, 1) }} KB
                                        </td>
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap; text-align: right; font-size: 0.875rem; font-weight: 500;">
                                            <a href="{{ route('shared-files.download', $file) }}" class="btn btn-primary" style="display: inline-flex;" title="Secure Download">
                                                <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
