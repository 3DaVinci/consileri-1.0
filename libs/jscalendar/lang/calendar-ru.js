// ** I18N

// Calendar EN language
// Author: Mihai Bazon, <mihai_bazon@yahoo.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Calendar._DN = new Array
("&#1074;&#1086;&#1089;&#1082;&#1088;&#1077;&#1089;&#1077;&#1085;&#1100;&#1077;",
 "&#1087;&#1086;&#1085;&#1077;&#1076;&#1077;&#1083;&#1100;&#1085;&#1080;&#1082;",
 "&#1074;&#1090;&#1086;&#1088;&#1085;&#1080;&#1082;",
 "&#1089;&#1088;&#1077;&#1076;&#1072;",
 "&#1095;&#1077;&#1090;&#1074;&#1077;&#1088;&#1075;",
 "&#1087;&#1103;&#1090;&#1085;&#1080;&#1094;&#1072;",
 "&#1089;&#1091;&#1073;&#1073;&#1086;&#1090;&#1072;",
 "&#1074;&#1086;&#1089;&#1082;&#1088;&#1077;&#1089;&#1077;&#1085;&#1100;&#1077;");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("&#1042;&#1089;",
 "&#1055;&#1085;",
 "&#1042;&#1090;",
 "&#1057;&#1088;",
 "&#1063;&#1090;",
 "&#1055;&#1090;",
 "&#1057;&#1073;",
 "&#1042;&#1089;");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Calendar._FD = 0;

// full month names
Calendar._MN = new Array
("&#1071;&#1085;&#1074;&#1072;&#1088;&#1100;",
 "&#1060;&#1077;&#1074;&#1088;&#1072;&#1083;&#1100;",
 "&#1052;&#1072;&#1088;&#1090;",
 "&#1040;&#1087;&#1088;&#1077;&#1083;&#1100;",
 "&#1052;&#1072;&#1081;",
 "&#1048;&#1102;&#1085;&#1100;",
 "&#1048;&#1102;&#1083;&#1100;",
 "&#1040;&#1074;&#1075;&#1091;&#1089;&#1090;",
 "&#1057;&#1077;&#1085;&#1090;&#1103;&#1073;&#1088;&#1100;",
 "&#1054;&#1082;&#1090;&#1103;&#1073;&#1088;&#1100;",
 "&#1053;&#1086;&#1103;&#1073;&#1088;&#1100;",
 "&#1044;&#1077;&#1082;&#1072;&#1073;&#1088;&#1100;");

// short month names
Calendar._SMN = new Array
("&#1071;&#1085;&#1074;",
 "&#1060;&#1077;&#1074;",
 "&#1052;&#1072;&#1088;",
 "&#1040;&#1087;&#1088;",
 "&#1052;&#1072;&#1081;",
 "&#1048;&#1102;&#1085;",
 "&#1048;&#1102;&#1083;",
 "&#1040;&#1074;&#1075;",
 "&#1057;&#1077;&#1085;",
 "&#1054;&#1082;&#1090;",
 "&#1053;&#1086;&#1103;",
 "&#1044;&#1077;&#1082;");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "About the calendar";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Date selection:\n" +
"- Use the \xab, \xbb buttons to select year\n" +
"- Use the " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " buttons to select month\n" +
"- Hold mouse button on any of the above buttons for faster selection.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Time selection:\n" +
"- Click on any of the time parts to increase it\n" +
"- or Shift-click to decrease it\n" +
"- or click and drag for faster selection.";

Calendar._TT["PREV_YEAR"] = "Prev. year (hold for menu)";
Calendar._TT["PREV_MONTH"] = "Prev. month (hold for menu)";
Calendar._TT["GO_TODAY"] = "Go Today";
Calendar._TT["NEXT_MONTH"] = "Next month (hold for menu)";
Calendar._TT["NEXT_YEAR"] = "Next year (hold for menu)";
Calendar._TT["SEL_DATE"] = "Select date";
Calendar._TT["DRAG_TO_MOVE"] = "Drag to move";
Calendar._TT["PART_TODAY"] = " (today)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "Display %s first";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Close";
Calendar._TT["TODAY"] = "&#1057;&#1077;&#1075;&#1086;&#1076;&#1085;&#1103;";
Calendar._TT["TIME_PART"] = "(Shift-)Click or drag to change value";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "";
Calendar._TT["TIME"] = "Time:";
