<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamMemberRequest;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        return view('admin.team.index', [
            'teamMembers' => TeamMember::query()->with('image')->orderBy('sort_order')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.team.create', [
            'teamMember' => new TeamMember([
                'is_active' => true,
                'sort_order' => TeamMember::query()->max('sort_order') + 1,
            ]),
        ]);
    }

    public function store(TeamMemberRequest $request): RedirectResponse
    {
        $member = TeamMember::query()->create($this->payload($request));

        return redirect()->route('admin.team.edit', $member)->with('status', 'Team member created successfully.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.edit', [
            'teamMember' => $team,
        ]);
    }

    public function update(TeamMemberRequest $request, TeamMember $team): RedirectResponse
    {
        $team->update($this->payload($request));

        return back()->with('status', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        $team->delete();

        return redirect()->route('admin.team.index')->with('status', 'Team member deleted successfully.');
    }

    protected function payload(TeamMemberRequest $request): array
    {
        $data = $request->validated();
        $data['social_links'] = array_filter([
            'linkedin' => $data['linkedin'] ?? null,
            'x' => $data['x'] ?? null,
            'website' => $data['website'] ?? null,
        ]);
        $data['is_active'] = $request->boolean('is_active');

        unset($data['linkedin'], $data['x'], $data['website']);

        return $data;
    }
}
