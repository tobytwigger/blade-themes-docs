@extends('layouts.docs')

@section('content')
    <h1>Docs</h1>
    <br/><hr/><br/>

    @foreach($schema as $group)
        <h2>{{$group->getName()}}</h2>

        @foreach($group->getComponents() as $component)
            <h3>{{$component->getName()}}</h3>

            Key: {{ $component->getKey() }}

            {{$component->getDescription()}}

            @if(count($component->getTips()) > 0)
                <ul>
                    @foreach($component->getTips() as $tip)
                        <li>{{$tip}}</li>
                    @endforeach
                </ul>
            @endif

            <h4>Attributes</h4>

            @foreach($component->getAttributes() as $attribute)
                <h5>{{$attribute->getName()}}</h5>
                {{$attribute->getDescription()}}
                <h6>Usage</h6>
                <pre><code>
                    {{'<x-su-' . $component->getKey() . ' ' . $attribute->getKey() . '="' . $attribute->getExampleValue() . '">' }}
                    {{'</x-su-' . $component->getKey() . '>' }}
                </code></pre>
                <h6>Allowed values</h6>
                @foreach($attribute->getAllowedValues() as $allowedValue)
                    {{$attribute->getKey()}}="{{$allowedValue->getValue()}}"

                    {{$allowedValue->getDescription()}}

                    @if(count($allowedValue->getTips()) > 0)
                        <ul>
                            @foreach($allowedValue->getTips() as $tip)
                                <li>{{$tip}}</li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            @endforeach

            @foreach($component->getSlots() as $slot)
                <h5>{{$slot->getName()}}</h5>
                {{$slot->getDescription()}}
                <h6>Usage</h6>
                @dd($slot)
                <pre><code>
                    {{'<x-su-' . $component->getKey() . '>' }}
                        {{'</x-slot-' . $slot->getKey() . '>' }}
{{--                        {{'<x-slot name="' . $slot->getKey() . '">'}}--}}
{{--                        {{'<x-slot name="' . $slot->getKey() . '">'}}--}}
{{--                            // See examples for what should be in here.--}}
                        {{'</x-slot>'}}
                    {{'</x-su-' . $component->getKey() . '>' }}
                </code></pre>
                <h6>Allowed values</h6>
                @foreach($attribute->getAllowedValues() as $allowedValue)
                    {{$attribute->getKey()}}="{{$allowedValue->getValue()}}"

                    {{$allowedValue->getDescription()}}

                    @if(count($allowedValue->getTips()) > 0)
                        <ul>
                            @foreach($allowedValue->getTips() as $tip)
                                <li>{{$tip}}</li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            @endforeach

        @endforeach
    @endforeach
@endsection

@push('styles')
    <style>
        pre {
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-left: 3px solid #f2334c;
            color: #666;
            page-break-inside: avoid;
            font-family: monospace;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 1.6em;
            max-width: 100%;
            overflow: auto;
            padding: 1em 1.5em;
            display: block;
            word-wrap: break-word;
        }
    </style>
@endpush
