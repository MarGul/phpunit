<?php

use \PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{

	/** @test */
	public function empty_instansieted_collection_returns_no_items()
	{
		$collection = new \App\Support\Collection;

		$this->assertEmpty($collection->get());
	}

	/** @test */
	public function count_is_correct_for_items_passed_in()
	{
		$collection = new \App\Support\Collection([
			'one', 'two', 'three'
		]);

		$this->assertEquals(3, $collection->count());
	}

	/** @test */
	public function items_returned_match_items_passed_in()
	{
		$collection = new \App\Support\Collection([
			'one', 'two', 'three'
		]);

		$this->assertCount(3, $collection->get());
		$this->assertEquals($collection->get()[0], 'one');
		$this->assertEquals($collection->get()[1], 'two');
		$this->assertEquals($collection->get()[2], 'three');
	}

	/** @test */
	public function collection_is_instance_of_iterator_aggregate()
	{
		$collection = new \App\Support\Collection();

		$this->assertInstanceOf(IteratorAggregate::class, $collection);
	}

	/** @test */
	public function collection_can_be_iterated()
	{
		$collection = new \App\Support\Collection([
			'one', 'two', 'three'
		]);

		$items = [];

		foreach ($collection as $item) {
			$items[] = $item;
		}

		$this->assertCount(3, $items);
		$this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
	}

	/** @test */
	public function collection_can_be_merged_with_anorther_collection()
	{
		$collection1 = new \App\Support\Collection(['one', 'two']);
		$collection2 = new \App\Support\Collection(['three', 'four', 'five']);

		$collection1->merge($collection2);

		$this->assertCount(5, $collection1->get());
		$this->assertEquals(5, $collection1->count());
	}

	/** @test */
	public function can_add_to_existing_collection()
	{
		$collection = new \App\Support\Collection([
			'one', 'two', 'three'
		]);

		$collection->add(['four']);

		$this->assertEquals(4, $collection->count());
		$this->assertCount(4, $collection->get());
	}

	/** @test */
	public function returns_json_encoded_items()
	{
		$collection = new \App\Support\Collection([
			['username' => 'Marcus'],
			['username' => 'Adde']
		]);

		$this->assertInternalType('string', $collection->toJson());
		$this->assertEquals('[{"username":"Marcus"},{"username":"Adde"}]', $collection->toJson());
	}

	/** @test */
	public function json_encoding_a_collect_object_returns_json()
	{
		$collection = new \App\Support\Collection([
			['username' => 'Marcus'],
			['username' => 'Adde']
		]);

		$encoded = json_encode($collection);

		$this->assertInternalType('string', $encoded);
		$this->assertEquals('[{"username":"Marcus"},{"username":"Adde"}]', $encoded);
	}
}