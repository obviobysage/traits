<?php

namespace ObvioBySage\Traits\Tests;

use Illuminate\Support\Facades\Event;
use ObvioBySage\Traits\Tests\TestCase;
use ObvioBySage\Traits\DispatchesNamedArguments;
use PHPUnit\Framework\Attributes\Test;

class Obj {
    use DispatchesNamedArguments;

    public function __construct(
        public string $named = '',
        public array $data = [],
    ) {}
}

class DispatchesNamedArgumentsTest extends TestCase
{
    #[Test]
    public function it_dispatch_with_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatch(
            named: $nameData,
            data: [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_dispatch_without_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatch(
            $nameData,
            [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_dispatch_without_arguments()
    {
        Event::fake();

        Obj::dispatch();

        Event::assertDispatched(
            Obj::class,
            function ($event) {
                return $event instanceof Obj &&
                    $event->named === '' &&
                    $event->data === [];
        });
    }

    #[Test]
    public function it_dispatchIf_with_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchIf(
            true,
            named: $nameData,
            data: [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_doesnt_dispatchIf_with_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchIf(
            false,
            named: $nameData,
            data: [$dataKey => $dataValue],
        );

        Event::assertNotDispatched(Obj::class);
    }

    #[Test]
    public function it_dispatchIf_without_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchIf(
            true,
            $nameData,
            [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_doesnt_dispatchIf_without_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchIf(
            false,
            $nameData,
            [$dataKey => $dataValue],
        );

        Event::assertNotDispatched(Obj::class);
    }

    #[Test]
    public function it_dispatchIf_without_arguments()
    {
        Event::fake();

        Obj::dispatchIf(true);

        Event::assertDispatched(
            Obj::class,
            function ($event) {
                return $event instanceof Obj &&
                    $event->named === '' &&
                    $event->data === [];
        });
    }

    #[Test]
    public function it_doesnt_dispatchIf_without_arguments()
    {
        Event::fake();

        Obj::dispatchIf(false);

        Event::assertNotDispatched(Obj::class);
    }

    #[Test]
    public function it_dispatchUnless_with_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchUnless(
            false,
            named: $nameData,
            data: [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_doesnt_dispatchUnless_with_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchUnless(
            true,
            named: $nameData,
            data: [$dataKey => $dataValue],
        );

        Event::assertNotDispatched(Obj::class);
    }

    #[Test]
    public function it_dispatchUnless_without_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchUnless(
            false,
            $nameData,
            [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_doesnt_dispatchUnless_without_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::dispatchUnless(
            true,
            $nameData,
            [$dataKey => $dataValue],
        );

        Event::assertNotDispatched(Obj::class);
    }

    #[Test]
    public function it_dispatchUnless_without_arguments()
    {
        Event::fake();

        Obj::dispatchUnless(false);

        Event::assertDispatched(
            Obj::class,
            function ($event) {
                return $event instanceof Obj &&
                    $event->named === '' &&
                    $event->data === [];
        });
    }

    #[Test]
    public function it_doesnt_dispatchUnless_without_arguments()
    {
        Event::fake();

        Obj::dispatchUnless(true);

        Event::assertNotDispatched(Obj::class);
    }

    #[Test]
    public function it_broadcast_with_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::broadcast(
            named: $nameData,
            data: [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_broadcast_without_named_arguments()
    {
        Event::fake();

        $nameData = 'the-name';
        $dataKey = 'the-key';
        $dataValue = 'the-value';

        Obj::broadcast(
            $nameData,
            [$dataKey => $dataValue],
        );

        Event::assertDispatched(
            Obj::class,
            function ($event) use ($nameData, $dataKey, $dataValue) {
                return $event instanceof Obj &&
                    $event->named === $nameData &&
                    empty($event->data) === false &&
                    $event->data[$dataKey] === $dataValue;
        });
    }

    #[Test]
    public function it_broadcast_without_arguments()
    {
        Event::fake();

        Obj::broadcast();

        Event::assertDispatched(
            Obj::class,
            function ($event) {
                return $event instanceof Obj &&
                    $event->named === '' &&
                    $event->data === [];
        });
    }
}
