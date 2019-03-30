<?php

use eftec\DashOne\DashOne;

class DashOneTest extends Bootstrap
{
	public function testRenderItem()
	{
		$this->dash=new DashOne();
		$idx=0;
		$this->assertEquals('hello',trim($this->dash->rawHtml('hello')->renderItem($idx)));
	}

	public function testFooter()
	{
		$this->dash=new DashOne();
		$idx=0;
		$this->assertEquals('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>',trim($this->dash->footer()->renderItem($idx)));
	}

	public function testStartMain()
	{
		$this->dash=new DashOne();
		$idx=0;
		$this->assertEquals('<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
<form method=\'post\'>
<input type=\'hidden\' name=\'_ispostback\' value=\'1\'/>',trim($this->dash->startMain()->renderItem($idx)));
	}

	public function testMenu()
	{
		$this->dash=new DashOne();
		$idx=0;
		$this->assertEqualsStrip('<nav class=\'col-md-2 d-none d-md-block bg-light leftmenu\'><div class=\'leftmenu-sticky\'><ul class=\'nav flex-column\'></ul></div></nav>',trim($this->dash->menu([])->renderItem($idx)));
	}

	public function testTable()
	{
		$this->dash=new DashOne();
		$idx=0;
		$this->assertEqualsStrip('<table class=\'table\'><thead><tr><th>a1</th><th>a2</th></tr></thead><tbody><tr class=\'\'><td>1</td><td>2</td></tr></tbody></table>'
				,trim($this->dash->table([['a1'=>'1','a2'=>'2']])->renderItem($idx)));
	}

	public function testRender()
	{
		$this->dash=new DashOne();
		$this->assertEquals('hello',trim($this->dash->rawHtml('hello')->render(true)));
	}

	public function testContainer()
	{
		$this->dash=new DashOne();

		$this->assertEquals('INIT hi
 END',trim($this->dash->container('INIT %control END')->rawHtml("hi")->render(true)));
	}

	public function testMenuUpper()
	{
		$this->dash=new DashOne();

		$this->assertEquals('<body>
		<nav class=\'navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow\'>
		    <span class=\'navbar-brand col-sm-3 col-md-2 mr-0\'></span><ul class=\'navbar-nav px-3\'>
		        <li class=\'nav-item text-nowrap\'>
		            <span class=\'nav-link\' href=\'#\'></span>
		        </li>
		    </ul>
		</nav>',trim($this->dash->menuUpper([],[])->render(true)));
	}

}
