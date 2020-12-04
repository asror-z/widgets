<?php
/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\consts;


interface ZChartWidgetConst
{

	/**
	 *
	 *
	 * Type
	 */

	public const Type_Line = 1;
	public const Type_LineStack = 2;
	public const Type_Bar = 3;
	public const Type_Pie = 4;


	public const type = [
	  	self::Type_Line,
	  	self::Type_LineStack,
	  	self::Type_Bar,
	];


	/**
	 *
	 * theme
	 */

	public const Theme_Infographic = 'infographic';
	public const Theme_Macarons = 'macarons';
	public const Theme_Roma = 'roma';
	public const Theme_Shine = 'shine';

	public const Theme_Dark = 'dark';
	public const Theme_Vintage = 'vintage';

	public const aTheme = [
		self::Theme_Shine,
		self::Theme_Infographic,
		self::Theme_Macarons,
	];


	/**
	 *
	 *
	 * Colors
	 */

	public const Color_Black = 'black';
	public const Color_White = 'white';
	public const Color_Blue = 'blue';
	public const Color_Red = 'red';
	public const Color_Pink = 'pink';


	/**
	 *
	 * Font Style
	 */

	public const FontStyle_Normal = 'normal';
	public const FontStyle_Italic = 'italic';
	public const FontStyle_Oblique = 'oblique';


	/**
	 *
	 * Font Weight
	 */

	public const FontWeight_Normal = 'normal';
	public const FontWeight_Bold = 'bold';
	public const FontWeight_Bolder = 'bolder';
	public const FontWeight_Lighter = 'lighter';


	public const Wrapper_Angular = 'angular';
	public const Wrapper_Bootstrap4 = 'bootstrap4';


	/**
	 *
	 * Axis Type
	 */

	public const AxisType_Category = 'category';
	public const Axtype_Time = 'time';
	public const AxisType_Value = 'value';


	/**
	 *
	 * Filter Mode
	 */

	public const FilterMode_Filter = 'filter';
	public const FilterMode_WeakFilter = 'weakFilter';
	public const FilterMode_Empty = 'empty';
	public const FilterMode_None = 'none';


	/**
	 *
	 * line types
	 */

	public const LineType_Solid = 'solid';
	public const LineType_Dashed = 'dashed';
	public const LineType_Dotted = 'dotted';


	/**
	 *
	 *
	 * Line Series Sampling
	 */

	public const Sampling_Average = 'average';
	public const Sampling_Max = 'max';
	public const Sampling_Min = 'min';
	public const Sampling_Sum = 'sum';


	/**
	 *
	 *
	 * Orientation
	 */

	public const Orientation_Vertical = 'vertical';
	public const Orientation_Horizontal = 'horizontal';


	/**
	 *
	 *
	 * Align
	 */

	public const Align_Auto = 'auto';
	public const Align_Center = 'center';
	public const Align_Right = 'right';
	public const Align_Left = 'left';


	/**
	 *
	 * Axis Pointer Type
	 */

	public const AxisPointer_Cross = 'cross';
	public const AxisPointer_Line = 'line';
	public const AxisPointer_Shadow = 'shadow';

	/**
	 *
	 *
	 * position
	 */

	public const Position_Top = 'top';
	public const Position_Middle = 'middle';
	public const Position_Bottom = 'bottom';


	/**
	 *
	 *
	 * Series Layout
	 */

	public const SeriesLayoutBy_Column = 'column';
	public const SeriesLayoutBy_Row = 'row';

	/**
	 *
	 * Line Symbols
	 */

	public const LineSymbol_Circle = 'circle';
	public const LineSymbol_Rect = 'rect';
	public const LineSymbol_RoundRect = 'roundRect';
	public const LineSymbol_Triangle = 'triangle';
	public const LineSymbol_Diamond = 'diamond';
	public const LineSymbol_Pin = 'pin';
	public const LineSymbol_Arrow = 'arrow';


	/**
	 *
	 * Label Positions
	 */

	public const LabelPosition_Top = 'top';
	public const LabelPosition_Left = 'left';
	public const LabelPosition_Right = 'right';
	public const LabelPosition_Bottom = 'bottom';
	public const LabelPosition_Inside = 'inside';
	public const LabelPosition_InsideLeft = 'insideLeft';
	public const LabelPosition_InsideRight = 'insideRight';
	public const LabelPosition_InsideTop = 'insideTop';
	public const LabelPosition_InsideBottom = 'insideBottom';
	public const LabelPosition_InsideTopLeft = 'insideTopLeft';
	public const LabelPosition_InsideTopRight = 'insideTopRight';
	public const LabelPosition_InsideBottomLeft = 'insideBottomLeft';
	public const LabelPosition_InsideBottomRight = 'insideBottomRight';


	/**
	 *
	 *
	 * Font Sizes
	 */

	public const FontSize_Large = '13';
	public const FontSize_Medium = '12';
	public const FontSize_Small = '11';
	public const FontSize_SmallEx = '10';


	/**
	 *
	 * Trigger
	 */

	public const Trigger_Item = 'item';
	public const Trigger_Axis = 'axis';


	/**
	 *
	 * Tooltip Trigger By
	 */

	public const TooltipTrigger_Mousemove = 'mousemove';
	public const TooltipTrigger_Click = 'click';
	public const TooltipTrigger_MousemoveClick = 'mousemove|click';
	public const TooltipTrigger_None = 'none';


	/**
	 *
	 * Event Contants
	 */

	public const Event_Click = 'Click';
	public const Event_Dblclick = 'Dblclick';

	public const Event_Mousedown = 'Mousedown';
	public const Event_Mousemove = 'Mousemove';
	public const Event_Mouseup = 'Mouseup';
	public const Event_Mouseover = 'Mouseover';
	public const Event_Mouseout = 'Mouseout';

	public const Event_Legendselectchanged = 'Legendselectchanged';
	public const Event_Legendselected = 'Legendselected';
	public const Event_Legendunselected = 'Legendunselected';
	public const Event_Legendscroll = 'Legendscroll';

	public const Event_Datazoom = 'Datazoom';
	public const Event_Datarangeselected = 'Datarangeselected';
	public const Event_Dataviewchanged = 'Dataviewchanged';

	public const Event_Timelinechanged = 'Timelinechanged';
	public const Event_Timelineplaychanged = 'Timelineplaychanged';

	public const Event_Restore = 'Restore';
	public const Event_Magictypechanged = 'Magictypechanged';

	public const Event_Pieselectchanged = 'Pieselectchanged';
	public const Event_Pieselected = 'Pieselected';
	public const Event_Pieunselected = 'Pieunselected';

	public const Event_Axisareaselected = 'Axisareaselected';
	public const Event_Focusnodeadjacency = 'Focusnodeadjacency';
	public const Event_Unfocusnodeadjacency = 'Unfocusnodeadjacency';

	public const Event_Brush = 'Brush';
	public const Event_Brushselected = 'Brushselected';


}
