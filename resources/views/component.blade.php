@extends('layouts.docs')

@section('content')
    <h1>Docs</h1>
    <br/><hr/><br/>

    <h2>{{$themeSchema->getName()}}</h2>
    @foreach($themeSchema->getComponents() as $component)
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

        <h4>Slots</h4>

        @foreach($component->getSlots() as $slot)
            <h5>{{$slot->getName()}}</h5>
            {{$slot->getDescription()}}
            <h6>Usage</h6>
            <pre><code>{{$slot->htmlForComponent($component->getKey(), 'su')}}</code></pre>
        @endforeach

        <h4>Examples</h4>
        @foreach($component->getExamples() as $example)
            <h3>{{$example->getName()}}</h3>

            {{$example->getDescription()}}

            @if(count($example->getTips()) > 0)
                <ul>
                    @foreach($example->getTips() as $tip)
                        <li>{{$tip}}</li>
                    @endforeach
                </ul>
            @endif

            <pre><code>
                    {{ $example->htmlForComponent($component->getKey(), 'su') }}
            </code></pre>

            @php($attributes = new \Illuminate\View\ComponentAttributeBag($example->getAttributeValues()))
            <x-dynamic-component :component="sprintf('docs-%s', $component->getKey())" {{ $attributes }}>
                {!! $example->htmlSlots() !!}
            </x-dynamic-component>

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
