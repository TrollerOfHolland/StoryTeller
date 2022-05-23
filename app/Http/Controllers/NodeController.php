<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Node;
use App\Models\Story;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $node = Node::find($id);
        $story = Story::find($node->story_id);
        return view('nodes.store', compact('node', 'story'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'content' => 'required',
            'option_one_text' => 'nullable',
            'option_two_text' => 'nullable',
            'option_three_text' => 'nullable',
        ], [
            'content.required' => 'Kötelező megadni valamilyen cselekményt!',
        ]);
        if (!$request->filled('option_one_text') && !$request->filled('option_two_text') && !$request->filled('option_three_text')) {
            return back()->with('missing_options', 'Kötelező megadni legalább egy opciót a történet pont létrehozásához')
                ->with('advice', 'Adja meg legalább az egyik történetszál nevét és kattintson a mentés gombra');
        }
        $node_id = $request->input('node_id');

        //true if this isnt the first node of the story
        //false if this is the first node of the story
        if ($node_id != NULL) {
            $node = Node::find($node_id);

            $child_data = [];
            $child_data['story_id'] = $request->input('story_id');
            $child_data['parent_id'] = $node->id;

            $node1 = Node::create($child_data);
            $node1->save();
            $node2 = Node::create($child_data);
            $node2->save();
            $node3 = Node::create($child_data);
            $node3->save();

            $node['content'] = $request->input('content');

            $node['option_one_text'] = $request->input('option_one_text');
            $node['option_two_text'] = $request->input('option_two_text');
            $node['option_three_text'] = $request->input('option_three_text');

            $node['option_one_id'] = $node1->id;
            $node['option_two_id'] = $node2->id;
            $node['option_three_id'] = $node3->id;

            $node->update();
            $request->session()->flash('node_updated', true);
            return redirect()->route('nodes.edit', $node->id);
        } else {
            $data['story_id'] = $request->input('story_id');
            $node = Node::create($data);
            $node->fixpoint = true;
            $node->save();

            $story = Story::find($request->input('story_id'));
            $story['node_id'] = $node->id;
            $story->update();

            $child_data = [];
            $child_data['story_id'] = $request->input('story_id');
            $child_data['parent_id'] = $node->id;

            $node1 = Node::create($child_data);
            $node1->save();
            $node2 = Node::create($child_data);
            $node2->save();
            $node3 = Node::create($child_data);
            $node3->save();

            $node['option_one_id'] = $node1->id;
            $node['option_two_id'] = $node2->id;
            $node['option_three_id'] = $node3->id;
            $node->update();

            $request->session()->flash('node_created', true);

            return redirect()->route('nodes.edit', $node->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $node = Node::find($id);
        $story = Story::find($node->story_id);
        if ($node->end) {
            return view('nodes.end', compact('node', 'story'));
        }
        $node1 = Node::find($node->option_one_id);
        $node2 = Node::find($node->option_two_id);
        $node3 = Node::find($node->option_three_id);

        $can_delete = false;
        if($node1->content == null && $node2->content == null && $node3->content == null && $node->parent_id != null) {
            $can_delete = true;
        }


        return view('nodes.update', compact('node', 'story', 'node1', 'node2', 'node3', 'can_delete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'content' => 'required',
            'option_one_text' => 'nullable',
            'option_two_text' => 'nullable',
            'option_three_text' => 'nullable',
        ], [
            'content.required' => 'Kötelező megadni valamilyen cselekményt!',
        ]);

        if (!$request->filled('option_one_text') && !$request->filled('option_two_text') && !$request->filled('option_three_text')) {
            return back()->with('missing_options', 'Kötelező megadni legalább egy opciót a történet pont létrehozásához')
                ->with('advice', 'Adja meg legalább az egyik történetszál nevét és kattintson a mentés gombra');
        }
        $node = Node::find($id);
        $node['content'] = $request->input('content');
        $node['option_one_text'] = $request->input('option_one_text');
        $node['option_two_text'] = $request->input('option_two_text');
        $node['option_three_text'] = $request->input('option_three_text');

        if ($request->has('end')) {
            $node['end'] = true;
        }
        if ($request->has('fixpoint')) {
            $node['fixpoint'] = true;
        }
        if ($request->has('remove_fixpoint')) {
            $node['fixpoint'] = false;
        }

        $node->update();
        $request->session()->flash('node_updated', true);
        return redirect()->route('nodes.edit', $node->id);
    }


    public function end(Request $request, $id)
    {
        $node = Node::find($id);

        if ($request->has('open')) {
            $node['end'] = false;
        }

        $node->update();
        $request->session()->flash('node_updated', true);
        return redirect()->route('nodes.edit', $node->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_node = Node::find($id);

        $child1 = Node::find($current_node->option_one_id);
        $child2 = Node::find($current_node->option_two_id);
        $child3 = Node::find($current_node->option_three_id);

        Schema::disableForeignKeyConstraints();
        Node::where('id', $child1->id)->delete();
        Node::where('id', $child2->id)->delete();
        Node::where('id', $child3->id)->delete();
        Schema::enableForeignKeyConstraints();

        $current_node->content = null;
        $current_node->option_one_id = null;
        $current_node->option_two_id = null;
        $current_node->option_three_id = null;
        $current_node->option_one_text = null;
        $current_node->option_two_text = null;
        $current_node->option_three_text = null;
        $current_node->update();

        Log::error($current_node);
        return redirect()->route('nodes.edit', $current_node->parent_id);
    }
    public function getFixpointWithoutDelete($id)
    {
        $current_node = Node::find($id);
        while(!$current_node->fixpoint) {
            $current_node = Node::find($current_node->parent_id);
        }
        return redirect()->route('nodes.edit', $current_node->id);

    }
}
