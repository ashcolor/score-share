@extends('layout')

@section('title', '曲一覧')

@section('content')
    <div class="container">
        <table>
            <thead>
            <th>ID</th>
            <th>曲名</th>
            <th>アーティスト</th>
            <th>作成日時</th>
            <th>作成者</th>
            <th>最終更新日時</th>
            <th>ジャンル</th>
            <th>備考</th>
            <th>URL</th>
            </thead>
            <tbody>
            @foreach($scores as $score)
                <tr>
                    <td>{{ $score->id }}</td>
                    <td>{{ $score->title }}</td>
                    <td>{{ $score->artist }}</td>
                    <td>{{ $score->score_created->name }}</td>
                    <td>{{ $score->score_created_at }}</td>
                    <td>{{ $score->score_modified_at }}</td>
                    <td>{{ $score->genre }}</td>
                    <td>{{ $score->remarks }}</td>
                    <td>{{ $score->url }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
