@extends('web.master')


@section('content')

<div class="frm-cntnr margin-a width--90">
	<div class="l-margin-tb inlineBlock-parent">
		<div class="width--50 align-t">
			<p class="frm-header bold clr--light-gray" style="font-size: 1.5em;">Color Palette</p>
			<div style="border: 1px solid #A9A9A9; width: 90%;"></div>
			<div class="inlineBlock-parent">

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #470000; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#470000</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #762B1C; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#762B1C</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #B56C58; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#B56C58</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #F5BC38; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#F5BC38</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #FFFFFF; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#FFFFFF</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #000000; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#000000</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #2B2B2B; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#2B2B2B</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #808080; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#808080</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #BBBBBB; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#BBBBBB</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #D2D2D2; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#D2D2D2</p>
				</div>

				<div style="margin-top: 20px; margin-right: 20px; text-align: center;">
					<div style="background: #A62E44; width: 60px; height: 60px; border-radius: 100%;"></div>
					<p style="margin-top: 20px;">#A62E44</p>
				</div>

			</div>
		</div
		><div class="width--50 align-t">
			<p class="frm-header bold clr--light-gray" style="font-size: 1.5em;">Typography</p>
			<div style="border: 1px solid #A9A9A9; width: 90%;"></div>
			
			<div style="margin-top: 20px;">
				<h1 class="m-margin-b">Heading 1 | 48px</h1>
				<h2 class="m-margin-b">Heading 2 | 31px</h2>
				<h3 class="m-margin-b">Heading 3 | 25px</h3>
				<h4 class="m-margin-b">Heading 4 | 20px</h4>
				<h5 class="m-margin-b">Heading 5 | 16px</h5>
				<h6 class="m-margin-b">Heading 6 | 13px</h6>
				<p class="m-margin-b">
					<span>Text Description 16px, It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.<strong>Text Description bold</strong></span>
				</p>
				<p class="m-margin-b">
					<small>Small | 11px</small>
				</p>
			</div>

		</div>
	</div>

	<div class="l-margin-tb inlineBlock-parent">
		<div class="width--50 align-t">
			<p class="frm-header bold clr--light-gray" style="font-size: 1.5em;">Fonts</p>
			<div style="border: 1px solid #A9A9A9; width: 90%;"></div>
			
			<div class="inlineBlock-parent" style="margin-top: 20px;">
				<div class="width--50">

					<h2 class="m-margin-b fntwght--bold">Barlow</h2>
					<p class="font-1">Barlow Regular</p>
					<p class="font-1 fntstyle--italic">Barlow Regular Italic</p>

					<p class="font-1 fntwght--medium">Barlow Medium</p>
					<p class="font-1 fntstyle--italic fntwght--medium">Barlow Medium Italic</p>

					<p class="font-1 fntwght--bold">Barlow Bold</p>
					<p class="font-1 fntstyle--italic fntwght--bold">Barlow Bold Italic</p>
				</div
				><div class="width--50">
					<h2 class="m-margin-b fntwght--bold">Museo Sans</h2>
					<p class="font-2">Museo Sans Regular</p>
					<p class="font-2 fntstyle--italic">Museo Sans Regular Italic</p>

					<p class="font-2 fntwght--medium">Museo Sans Medium</p>
					<p class="font-2 fntwght--medium fntstyle--italic">Museo Sans Medium Italic</p>

					<p class="font-2 fntwght--bold">Museo Sans Bold</p>
					<p class="font-2 fntwght--bold fntstyle--italic">Museo Sans Bold Italic</p>
				</div>
			</div>

		</div
		><div class="width--50 align-t">
			<p class="frm-header bold clr--light-gray" style="font-size: 1.5em;">Misc</p>
			<div style="border: 1px solid #A9A9A9; width: 90%;"></div>
			<div class="inlineBlock-parent">

				<div class="width--25 overflow-hidden cstm-border-radius--8" style="background: #D2D2D2; margin-top: 20px; margin-right: 5%; margin-right: 5%;">
					<p style="margin: 20px 0; text-align: center;">Border Radius 8</p>
				</div>

				<div class="width--25 overflow-hidden cstm-border-radius--5" style="background: #D2D2D2; margin-top: 20px; margin-right: 5%; margin-right: 5%;">
					<p style="margin: 20px 0; text-align: center;">Border Radius 5</p>
				</div>
			</div>

			<div class="inlineBlock-parent">

				<div class="width--25 overflow-hidden cstm-box-shadow-25" style="background: #D2D2D2; margin-top: 20px; margin-right: 5%; margin-right: 5%;">
					<p style="margin: 20px 0; text-align: center;">Box Shadow 25</p>
				</div>

				<div class="width--25 overflow-hidden cstm-box-shadow-15" style="background: #D2D2D2; margin-top: 20px; margin-right: 5%; margin-right: 5%;">
					<p style="margin: 20px 0; text-align: center;">Box Shadow 15</p>
				</div>

				<div class="width--25 overflow-hidden cstm-box-shadow-1" style="background: #D2D2D2; margin-top: 20px; margin-right: 5%; margin-right: 5%;">
					<p style="margin: 20px 0; text-align: center;">Box Shadow 1</p>
				</div>
			</div>

		</div>
	</div>

	<div class="l-margin-tb inlineBlock-parent">
		<div class="width--50 align-t">
			<p class="frm-header bold clr--light-gray" style="font-size: 1.5em;">Buttons</p>
			<div style="border: 1px solid #A9A9A9; width: 90%;"></div>
			
			<div style="margin-top: 20px;">
				<button class="btn type-1">Type 1</button>
			</div>

			<div style="margin-top: 20px;">
				<button class="btn type-2">Type 2</button>
			</div>

			<div style="margin-top: 20px;">
				<button class="btn type-1 btn--bdrRad--0">Border Radius Reset</button>
			</div>

			<div style="margin-top: 20px;">
				<button class="btn type-1 btn--bxSdw--0">Box Shadow Unset</button>
			</div>

		</div
		><div class="width--50 align-t">
			<p class="frm-header bold clr--light-gray" style="font-size: 1.5em;">Forms</p>
			<div style="border: 1px solid #A9A9A9; width: 90%;"></div>
			
			<div style="margin-top: 20px;">
				<div class="frm--input m-margin-b">
					<label class="frm--label"><span>Text Input</span>
						<input class="frm--text" type="text" name="" placeholder="Input text">
					</label>
				</div>
				<div class="frm--input m-margin-b">
					<label class="frm--label"><span>Number Input</span>
						<input class="frm--number" type="number" name="" placeholder="Input text">
					</label>
				</div>
				<div class="frm--input m-margin-b">
					<label class="frm--label"><span>Select Input</span>
						<select class="frm--select">
							<option disabled selected>Select</option>
							<option>Option 1</option>
						</select>
					</label>
				</div>
				<div class="frm--input m-margin-b">
					<label class="frm--label"><span>Textarea Input</span>
						<textarea class="frm--textarea" rows="4" placeholder="text here"></textarea>
					</label>
				</div>
				<div class="frm--input m-margin-b">
					<label class="frm--label with-icon"><span>Prepend</span>
						<input class="frm--text prepend" type="text" name="" placeholder="Input text">
						<i class="fa fa-user"></i>
					</label>
				</div>
				<div class="frm--input m-margin-b">
					<label class="frm--label with-icon"><span>Append</span>
						<select class="frm--select append">
							<option disabled selected>Select</option>
							<option>Option 1</option>
						</select>
						<i class="fas fa-caret-down"></i>
					</label>
				</div>
				<div class="frm--input m-margin-b">
					<label class="frm--label cstm"><span>Number Input</span>
						<input class="frm--number prepend cstm" type="number" name="" placeholder="Input text">
					</label>
				</div>

			</div>

		</div>
	</div>

</div>

@endsection