<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Node;
use App\Models\Story;

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
            return back()->with('missing_option', 'Kötelező megadni legalább egy opciót a történet pont létrehozásához');
        }
        $node_id = $request->input('node_id');
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
            $story = Story::find($request->input('story_id'));
            $data['story_id'] = $request->input('story_id');
            $node = $story->node()->create($data);
            $node->save();

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
        $node1 = Node::find($node->option_one_id);
        $node2 = Node::find($node->option_two_id);
        $node3 = Node::find($node->option_three_id);

        return view('nodes.update', compact('node', 'story', 'node1', 'node2', 'node3'));
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
            return back()->with('missing_option', 'Kötelező megadni legalább egy opciót a történet pont létrehozásához');
        }
        $node = Node::find($id);
        $node['content'] = $request->input('content');
        $node['option_one_text'] = $request->input('option_one_text');
        $node['option_two_text'] = $request->input('option_two_text');
        $node['option_three_text'] = $request->input('option_three_text');

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
    public function destroy(Request $request)
    {
    }
}