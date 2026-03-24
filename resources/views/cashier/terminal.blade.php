@extends('layouts.master')

@section('title')
<title>POS Terminal | AccessMaster</title>
@endsection

@section('css')
<style>
/* ══ VELZON THEME VARIABLES ══ */
.trm {
  --v-primary:    #405189;
  --v-primary-h:  #364474;
  --v-primary-s:  rgba(64,81,137,.10);
  --v-primary-m:  rgba(64,81,137,.22);
  --v-success:    #0ab39c;
  --v-success-h:  #099d88;
  --v-success-s:  rgba(10,179,156,.10);
  --v-success-m:  rgba(10,179,156,.22);
  --v-warning:    #f7b84b;
  --v-warning-s:  rgba(247,184,75,.10);
  --v-warning-m:  rgba(247,184,75,.25);
  --v-danger:     #f06548;
  --v-danger-s:   rgba(240,101,72,.10);
  --v-danger-m:   rgba(240,101,72,.22);
  --v-info:       #299cdb;
  --v-info-s:     rgba(41,156,219,.10);
  --v-bg:         #f3f3f9;
  --v-white:      #ffffff;
  --v-border:     #e9ebec;
  --v-border-2:   #d5d8de;
  --v-text:       #212529;
  --v-text-2:     #6c757d;
  --v-text-3:     #adb5bd;
  --v-sh:   0 1px 2px rgba(56,65,74,.15);
  --v-shmd: 0 3px 10px rgba(56,65,74,.12);
  --v-shlg: 0 8px 24px rgba(56,65,74,.15);
  --v-r:   0.25rem;
  --v-rm:  0.35rem;
  --v-rl:  0.5rem;

  font-family: var(--vz-body-font-family, 'Poppins', sans-serif);
  background: var(--v-bg);
  color: var(--v-text);
  display: grid;
  height: calc(100vh - 70px);
  grid-template-rows: 48px 1fr;
  grid-template-columns: 1fr 340px;
  overflow: hidden;
}
.page-content { padding: 0 !important; overflow: hidden !important; }
.trm *::-webkit-scrollbar { width: 4px; height: 4px; }
.trm *::-webkit-scrollbar-thumb { background: var(--v-border-2); border-radius: 2px; }

/* ══ STEP BAR ══ */
.trm-steps {
  grid-column: 1 / -1;
  background: var(--v-white); border-bottom: 1px solid var(--v-border);
  display: flex; align-items: center; padding: 0 16px;
  overflow-x: auto; flex-shrink: 0; box-shadow: var(--v-sh);
}
.trm-steps::-webkit-scrollbar { display: none; }
.ts-item { display: flex; align-items: center; gap: 8px; padding: 0 14px 0 0; cursor: pointer; opacity: .4; transition: opacity .2s; flex-shrink: 0; }
.ts-item.active { opacity: 1; }
.ts-item.done   { opacity: .7; }
.ts-item.done:hover { opacity: 1; }
.ts-num {
  width: 24px; height: 24px; border-radius: 50%;
  border: 2px solid var(--v-border-2); background: var(--v-white);
  display: flex; align-items: center; justify-content: center;
  font-size: 10.5px; font-weight: 700; color: var(--v-text-2);
  flex-shrink: 0; transition: all .2s;
}
.ts-item.active .ts-num { background: var(--v-primary); border-color: var(--v-primary); color: #fff; box-shadow: 0 2px 8px var(--v-primary-m); }
.ts-item.done .ts-num   { background: var(--v-success); border-color: var(--v-success); color: #fff; }
.ts-lbl { font-size: 12px; font-weight: 600; white-space: nowrap; color: var(--v-text); }
.ts-item.active .ts-lbl { color: var(--v-primary); }
.ts-sep { width: 20px; height: 1px; background: var(--v-border-2); flex-shrink: 0; margin-right: 4px; }
.ts-item.done + .ts-sep { background: var(--v-success-m); }

/* ══ MAIN ══ */
.trm-main { display: flex; flex-direction: column; background: var(--v-bg); overflow: hidden; }
.trm-page { display: none; flex-direction: column; height: 100%; overflow: hidden; animation: vFU .18s ease; }
.trm-page.active { display: flex; }
@keyframes vFU { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }

.pg-head { padding: 12px 18px 8px; flex-shrink: 0; border-bottom: 1px solid var(--v-border); background: var(--v-white); }
.pg-title { font-size: 14px; font-weight: 700; color: var(--v-text); display: flex; align-items: center; gap: 8px; }
.pg-title i { color: var(--v-primary); font-size: 16px; }
.pg-sub { font-size: 11.5px; color: var(--v-text-2); margin-top: 2px; }
.pg-body { flex: 1; overflow-y: auto; padding: 14px 16px 16px; }

/* ══ PAGE 1: MENU ══ */
.menu-sw { display: flex; gap: 8px; margin-bottom: 12px; }
.msbox { flex:1; display:flex; align-items:center; gap:7px; background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); padding:0 11px; box-shadow:var(--v-sh); transition:border-color .15s; }
.msbox:focus-within { border-color:var(--v-primary); }
.msbox i { color:var(--v-text-3); font-size:14px; flex-shrink:0; }
.msbox input { flex:1; border:none; background:none; outline:none; font-size:13px; color:var(--v-text); font-family:inherit; padding:8px 0; }
.msbox input::placeholder { color:var(--v-text-3); }
.cat-row { display:flex; gap:6px; margin-bottom:12px; overflow-x:auto; flex-wrap:nowrap; }
.cat-row::-webkit-scrollbar { display:none; }
.cpill { padding:4px 12px; border-radius:20px; border:1px solid var(--v-border); background:var(--v-white); color:var(--v-text-2); font-size:11.5px; font-weight:600; cursor:pointer; white-space:nowrap; transition:all .15s; font-family:inherit; box-shadow:var(--v-sh); }
.cpill:hover { border-color:var(--v-border-2); color:var(--v-text); }
.cpill.on { background:var(--v-primary); border-color:var(--v-primary); color:#fff; box-shadow:0 2px 8px var(--v-primary-m); }
.msec-lbl { font-size:10px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--v-text-3); margin:14px 0 8px; padding-bottom:6px; border-bottom:1px solid var(--v-border); }
.mgrid { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:8px; margin-bottom:4px; }
.mitem { background:var(--v-white); border:1.5px solid var(--v-border); border-radius:var(--v-rl); padding:12px 10px; cursor:pointer; transition:all .18s; position:relative; user-select:none; box-shadow:var(--v-sh); }
.mitem:hover { border-color:var(--v-primary-m); box-shadow:var(--v-shmd),0 0 0 3px var(--v-primary-s); transform:translateY(-1px); }
.mitem:active { transform:scale(.97); }
.mitem.inorder { border-color:var(--v-primary); background:#f0f3fc; box-shadow:var(--v-shmd),0 0 0 3px var(--v-primary-s); }
.mitem.inorder .mi-nm { color:var(--v-primary); }
.mi-qbadge { position:absolute; top:7px; right:7px; min-width:20px; height:20px; border-radius:10px; padding:0 5px; background:var(--v-primary); color:#fff; font-size:10px; font-weight:800; display:none; align-items:center; justify-content:center; }
.mitem.inorder .mi-qbadge { display:flex; }
.mi-em { font-size:26px; margin-bottom:8px; }
.mi-nm { font-size:12px; font-weight:600; color:var(--v-text); line-height:1.3; margin-bottom:8px; }
.mi-ft { display:flex; align-items:center; justify-content:space-between; }
.mi-pr { font-size:12.5px; font-weight:700; color:var(--v-primary); }
.mi-ab { width:22px; height:22px; border-radius:4px; background:var(--v-primary-s); border:1px solid var(--v-primary-m); color:var(--v-primary); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:15px; transition:all .15s; }
.mi-ab:hover, .mitem.inorder .mi-ab { background:var(--v-primary); color:#fff; }

/* ══ PAGE 2: LOYALTY ══ */
.loy-row { display:flex; gap:8px; margin-bottom:14px; }
.loy-inp { flex:1; background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); padding:9px 13px; font-size:13px; color:var(--v-text); font-family:inherit; outline:none; box-shadow:var(--v-sh); transition:border-color .15s; }
.loy-inp:focus { border-color:var(--v-success); box-shadow:0 0 0 3px var(--v-success-s); }
.loy-inp::placeholder { color:var(--v-text-3); }
.btn-find { padding:9px 16px; border-radius:var(--v-rl); background:var(--v-success); border:none; color:#fff; font-size:12.5px; font-weight:600; cursor:pointer; font-family:inherit; display:flex; align-items:center; gap:6px; transition:all .15s; white-space:nowrap; }
.btn-find:hover { background:var(--v-success-h); transform:translateY(-1px); }
.btn-skip { padding:9px 13px; border-radius:var(--v-rl); border:1px solid var(--v-border); background:var(--v-white); color:var(--v-text-2); font-size:12px; font-weight:600; cursor:pointer; font-family:inherit; display:flex; align-items:center; gap:5px; transition:all .15s; white-space:nowrap; box-shadow:var(--v-sh); }
.btn-skip:hover { background:var(--v-bg); border-color:var(--v-border-2); color:var(--v-text); }
.loy-empty { text-align:center; padding:28px; color:var(--v-text-3); font-size:12.5px; background:var(--v-white); border-radius:var(--v-rl); border:1px dashed var(--v-border); }
.reg-lnk { color:var(--v-primary); cursor:pointer; font-weight:600; text-decoration:underline; }
/* customer card */
.cust-card { background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); overflow:hidden; margin-bottom:14px; box-shadow:var(--v-shmd); animation:vPop .22s cubic-bezier(.34,1.56,.64,1); }
@keyframes vPop { from{opacity:0;transform:scale(.94);}to{opacity:1;transform:scale(1);} }
.cc-hd { padding:14px 16px; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#405189,#364474); }
.cc-av { width:42px; height:42px; border-radius:50%; background:rgba(255,255,255,.2); border:2px solid rgba(255,255,255,.35); display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; color:#fff; flex-shrink:0; }
.cc-info { flex:1; }
.cc-name { font-size:14px; font-weight:700; color:#fff; }
.cc-meta { font-size:11px; color:rgba(255,255,255,.75); margin-top:2px; display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
.cc-tier { background:rgba(247,184,75,.25); color:#f7b84b; border:1px solid rgba(247,184,75,.4); border-radius:4px; padding:1px 7px; font-size:10px; font-weight:700; }
.cc-unlink { background:rgba(255,255,255,.15); border:none; color:rgba(255,255,255,.7); cursor:pointer; font-size:18px; width:28px; height:28px; border-radius:var(--v-r); display:flex; align-items:center; justify-content:center; transition:all .15s; }
.cc-unlink:hover { background:rgba(240,101,72,.35); color:#fff; }
.cc-stats { display:grid; grid-template-columns:1fr 1fr 1fr; border-top:1px solid var(--v-border); }
.cc-stat { padding:11px 14px; border-right:1px solid var(--v-border); }
.cc-stat:last-child { border-right:none; }
.cc-sl { font-size:10px; color:var(--v-text-3); text-transform:uppercase; letter-spacing:.8px; font-weight:600; margin-bottom:3px; }
.cc-sv { font-size:14px; font-weight:700; color:var(--v-text); }
.cc-sv.warn { color:var(--v-warning); }
.cc-sv.suc  { color:var(--v-success); }
/* pts */
.pts-ch { background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); padding:16px; box-shadow:var(--v-sh); margin-bottom:14px; }
.pts-ch-ttl { font-size:13px; font-weight:700; margin-bottom:3px; }
.pts-ch-sub { font-size:12px; color:var(--v-text-2); margin-bottom:14px; line-height:1.6; }
.pts-opts { display:flex; gap:8px; margin-bottom:14px; }
.pts-opt { flex:1; padding:12px; border-radius:var(--v-rl); border:1.5px solid var(--v-border); background:var(--v-bg); cursor:pointer; text-align:center; transition:all .18s; user-select:none; }
.pts-opt:hover { border-color:var(--v-border-2); background:var(--v-white); }
.pts-opt.yes { border-color:var(--v-success); background:var(--v-success-s); box-shadow:0 0 0 3px var(--v-success-s); }
.pts-opt.no  { border-color:var(--v-danger);  background:var(--v-danger-s); }
.pts-opt-ic { font-size:22px; margin-bottom:6px; }
.pts-opt-t  { font-size:12.5px; font-weight:700; color:var(--v-text); }
.pts-opt-s  { font-size:11px; color:var(--v-text-2); margin-top:2px; }
.pts-opt.yes .pts-opt-t { color:var(--v-success); }
.pts-sl-sec { display:none; animation:vFU .18s ease; }
.pts-sl-sec.show { display:block; }
.pts-sl-hd  { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.pts-sl-hd .ll { font-size:11.5px; color:var(--v-text-2); font-weight:600; }
.pts-sl-hd .vv { font-size:13px; font-weight:700; color:var(--v-warning); }
input[type=range].vrange { -webkit-appearance:none; width:100%; height:5px; border-radius:3px; background:linear-gradient(90deg,var(--v-warning) var(--pct,0%),var(--v-border) var(--pct,0%)); outline:none; cursor:pointer; margin-bottom:6px; }
input[type=range].vrange::-webkit-slider-thumb { -webkit-appearance:none; width:18px; height:18px; border-radius:50%; background:var(--v-warning); border:3px solid #fff; box-shadow:0 1px 6px rgba(247,184,75,.4); cursor:pointer; }
.pts-sl-lbr { display:flex; justify-content:space-between; font-size:10.5px; color:var(--v-text-3); margin-bottom:12px; }
.pts-sum { display:flex; align-items:center; justify-content:space-between; background:linear-gradient(135deg,#fffbf0,#fef5d6); border:1px solid rgba(247,184,75,.3); border-radius:var(--v-rm); padding:10px 14px; }
.ps-l { font-size:10.5px; color:var(--v-text-2); }
.ps-v { font-size:15px; font-weight:700; color:var(--v-warning); }
.ps-d { width:1px; height:32px; background:rgba(247,184,75,.3); }
.ps-s { font-size:15px; font-weight:700; color:var(--v-success); }

/* ══ PAGE 3: VOUCHER ══ */
.v-card { background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); padding:16px; box-shadow:var(--v-sh); margin-bottom:14px; }
.v-ttl  { font-size:13px; font-weight:700; color:var(--v-text); margin-bottom:3px; }
.v-sub  { font-size:12px; color:var(--v-text-2); line-height:1.6; margin-bottom:14px; }
.v-irow { display:flex; gap:8px; margin-bottom:12px; }
.v-inp  { flex:1; background:var(--v-bg); border:1px solid var(--v-border); border-radius:var(--v-rm); padding:9px 13px; font-size:13.5px; font-weight:700; color:var(--v-text); font-family:inherit; letter-spacing:1.5px; text-transform:uppercase; outline:none; transition:border-color .15s; }
.v-inp:focus { border-color:var(--v-primary); box-shadow:0 0 0 3px var(--v-primary-s); }
.v-inp::placeholder { letter-spacing:0; font-weight:400; font-size:12.5px; color:var(--v-text-3); }
.btn-ap { padding:9px 18px; border-radius:var(--v-rm); background:var(--v-primary); border:none; color:#fff; font-size:13px; font-weight:600; cursor:pointer; font-family:inherit; transition:all .15s; white-space:nowrap; }
.btn-ap:hover { background:var(--v-primary-h); transform:translateY(-1px); box-shadow:0 3px 10px var(--v-primary-m); }
.v-applied { display:flex; align-items:center; gap:10px; background:var(--v-success-s); border:1px solid var(--v-success-m); border-radius:var(--v-rm); padding:11px 14px; }
.va-ico  { font-size:20px; flex-shrink:0; }
.va-info { flex:1; }
.va-nm   { font-size:13px; font-weight:700; color:var(--v-text); }
.va-sv   { font-size:12px; color:var(--v-success); font-weight:600; margin-top:1px; }
.btn-vrm { background:none; border:none; color:var(--v-text-3); cursor:pointer; font-size:18px; transition:color .15s; }
.btn-vrm:hover { color:var(--v-danger); }
.v-info-box { display:flex; align-items:flex-start; gap:8px; background:var(--v-info-s); border:1px solid rgba(41,156,219,.25); border-radius:var(--v-rm); padding:11px 14px; font-size:12px; color:var(--v-text-2); line-height:1.6; margin-bottom:14px; }
.v-info-box i { color:var(--v-info); font-size:16px; flex-shrink:0; margin-top:1px; }
.v-sec-lbl { font-size:10px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--v-text-3); margin:16px 0 8px; }
.v-cust-tag { display:inline-flex; align-items:center; gap:4px; background:var(--v-success-s); border:1px solid var(--v-success-m); border-radius:4px; padding:2px 7px; font-size:10px; font-weight:700; color:var(--v-success); margin-left:6px; }
.vlist { display:flex; flex-direction:column; gap:7px; }
.vrow { display:flex; align-items:center; gap:10px; background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rm); padding:10px 13px; cursor:pointer; transition:all .15s; box-shadow:var(--v-sh); }
.vrow:hover { border-color:var(--v-primary-m); background:#f7f8fd; }
.vrow.linked { border-left:3px solid var(--v-success); }
.vbdg { background:var(--v-primary-s); border:1px solid var(--v-primary-m); border-radius:4px; padding:4px 9px; font-size:11px; font-weight:700; color:var(--v-primary); letter-spacing:.5px; flex-shrink:0; }
.vrow.linked .vbdg { background:var(--v-success-s); border-color:var(--v-success-m); color:var(--v-success); }
.vinfo { flex:1; }
.vnm  { font-size:12.5px; font-weight:600; color:var(--v-text); }
.vexp { font-size:11px; color:var(--v-text-3); margin-top:1px; }
.vdsc { font-size:13.5px; font-weight:700; color:var(--v-success); }

/* ══ PAGE 4: PAYMENT ══ */
.pay-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:16px; }
.popt { background:var(--v-white); border:1.5px solid var(--v-border); border-radius:var(--v-rl); padding:14px 12px; text-align:center; cursor:pointer; transition:all .18s; user-select:none; box-shadow:var(--v-sh); }
.popt:hover { border-color:var(--v-border-2); transform:translateY(-1px); box-shadow:var(--v-shmd); }
.popt.sel { border-color:var(--v-primary); background:#f0f3fc; box-shadow:var(--v-shmd),0 0 0 3px var(--v-primary-s); }
.popt-ic { font-size:26px; margin-bottom:8px; }
.popt-nm { font-size:12.5px; font-weight:700; color:var(--v-text); }
.popt-ds { font-size:11px; color:var(--v-text-2); margin-top:2px; line-height:1.4; }
.popt.sel .popt-nm { color:var(--v-primary); }
.pdet { display:none; background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); padding:16px; box-shadow:var(--v-sh); animation:vFU .18s ease; }
.pdet.show { display:block; }
.pd-ttl { font-size:13px; font-weight:700; margin-bottom:14px; display:flex; align-items:center; gap:7px; color:var(--v-text); }
.pd-ttl i { color:var(--v-primary); }
.frow { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:10px; }
.fg   { margin-bottom:10px; }
.fl   { display:block; font-size:10.5px; font-weight:700; color:var(--v-text-2); margin-bottom:4px; text-transform:uppercase; letter-spacing:.8px; }
.fc   { width:100%; background:var(--v-bg); border:1px solid var(--v-border); border-radius:var(--v-rm); padding:8px 12px; font-size:13px; color:var(--v-text); font-family:inherit; outline:none; transition:border-color .15s; }
.fc:focus { border-color:var(--v-primary); box-shadow:0 0 0 3px var(--v-primary-s); }
.fc::placeholder { color:var(--v-text-3); }
.dgrid { display:grid; grid-template-columns:repeat(3,1fr); gap:6px; margin-bottom:11px; }
.dbn { padding:8px; border-radius:var(--v-rm); background:var(--v-bg); border:1px solid var(--v-border); color:var(--v-text); font-size:12px; font-weight:600; cursor:pointer; text-align:center; font-family:inherit; transition:all .13s; }
.dbn:hover { border-color:var(--v-primary-m); color:var(--v-primary); background:var(--v-primary-s); }
.dbn.full { grid-column:span 3; }
.amt-wrap { position:relative; }
.amt-pre { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--v-text-2); font-weight:600; font-size:12.5px; pointer-events:none; }
.fc.pl { padding-left:44px; }
.chg-row { display:flex; align-items:center; justify-content:space-between; background:var(--v-success-s); border:1px solid var(--v-success-m); border-radius:var(--v-rm); padding:9px 14px; margin-top:8px; }
.chg-row.hidden { display:none; }
.chg-l { font-size:12.5px; color:var(--v-text-2); font-weight:600; }
.chg-v { font-size:17px; font-weight:700; color:var(--v-success); }
.binfo { background:var(--v-info-s); border:1px solid rgba(41,156,219,.25); border-radius:var(--v-rm); padding:12px 14px; margin-bottom:12px; }
.bir { display:flex; justify-content:space-between; font-size:12px; padding:3px 0; }
.bir .bk { color:var(--v-text-2); font-weight:600; }
.bir .bv { font-weight:700; color:var(--v-text); }
.bir .bvc { color:var(--v-primary); cursor:pointer; text-decoration:underline; }
.hint { display:flex; align-items:flex-start; gap:7px; background:var(--v-warning-s); border:1px solid var(--v-warning-m); border-radius:var(--v-rm); padding:9px 12px; font-size:11.5px; color:var(--v-text-2); line-height:1.6; margin-top:8px; }
.hint i { color:var(--v-warning); flex-shrink:0; margin-top:1px; }

/* ══ PAGE 5: RECEIPT ══ */
.rcpg { display:flex; flex-direction:column; align-items:center; padding:24px 20px; overflow-y:auto; height:100%; }
.rc-ico  { font-size:52px; margin-bottom:12px; animation:vPop .4s cubic-bezier(.34,1.56,.64,1) .1s both; }
.rc-ttl  { font-size:20px; font-weight:700; color:var(--v-text); margin-bottom:4px; }
.rc-sub  { font-size:12.5px; color:var(--v-text-2); margin-bottom:20px; text-align:center; }
.pts-ebox { width:100%; background:linear-gradient(135deg,#fffbf0,#fef5d6); border:1px solid rgba(247,184,75,.35); border-radius:var(--v-rl); padding:14px 16px; margin-bottom:14px; display:flex; align-items:center; gap:12px; }
.pe-i { font-size:28px; }
.pe-p { font-size:20px; font-weight:700; color:var(--v-warning); }
.pe-n { font-size:12px; font-weight:600; color:var(--v-text); margin-top:1px; }
.pe-b { font-size:11px; color:var(--v-text-2); }
.rcbox { width:100%; background:var(--v-white); border:1px solid var(--v-border); border-radius:var(--v-rl); padding:14px 16px; margin-bottom:16px; box-shadow:var(--v-sh); }
.rcr { display:flex; justify-content:space-between; font-size:12px; color:var(--v-text-2); padding:3px 0; }
.rcr .rv { font-weight:500; color:var(--v-text); }
.rcr.tot { font-size:14px; font-weight:700; color:var(--v-text); border-top:1px solid var(--v-border); padding-top:10px; margin-top:7px; }
.rcr.tot .rv { color:var(--v-primary); font-size:16px; }
.rc-acts { display:grid; grid-template-columns:1fr 1fr; gap:8px; width:100%; }
.rc-btn { padding:11px; border-radius:var(--v-rm); font-size:12.5px; font-weight:600; cursor:pointer; font-family:inherit; transition:all .15s; display:flex; align-items:center; justify-content:center; gap:6px; }
.rc-btn.out { background:var(--v-white); border:1px solid var(--v-border); color:var(--v-text-2); box-shadow:var(--v-sh); }
.rc-btn.out:hover { background:var(--v-bg); border-color:var(--v-border-2); color:var(--v-text); }
.rc-btn.sol { background:var(--v-primary); border:none; color:#fff; box-shadow:0 3px 10px var(--v-primary-m); }
.rc-btn.sol:hover { background:var(--v-primary-h); transform:translateY(-1px); }

/* ══ ORDER PANEL ══ */
.order-panel { background:var(--v-white); border-left:1px solid var(--v-border); display:flex; flex-direction:column; overflow:hidden; }
.op-hd { padding:12px 14px 10px; border-bottom:1px solid var(--v-border); flex-shrink:0; display:flex; align-items:center; justify-content:space-between; }
.op-l  { display:flex; align-items:center; gap:8px; }
.op-ttl { font-size:13.5px; font-weight:700; color:var(--v-text); }
.op-cnt { background:var(--v-primary-s); color:var(--v-primary); border:1px solid var(--v-primary-m); border-radius:10px; padding:1px 8px; font-size:10.5px; font-weight:700; }
.btn-clr { background:none; border:1px solid var(--v-border); border-radius:var(--v-r); color:var(--v-text-2); font-size:11.5px; font-weight:600; cursor:pointer; padding:3px 10px; font-family:inherit; transition:all .15s; display:flex; align-items:center; gap:4px; }
.btn-clr:hover { color:var(--v-danger); border-color:var(--v-danger-m); background:var(--v-danger-s); }
.op-items { flex:1; overflow-y:auto; padding:10px 12px; }
.op-empty { display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; gap:7px; color:var(--v-text-3); }
.op-empty .oei { font-size:36px; opacity:.22; }
.op-empty p { font-size:12px; }
.oi { display:flex; align-items:center; gap:8px; padding:8px 10px; border-radius:var(--v-rm); border:1px solid var(--v-border); margin-bottom:6px; background:var(--v-bg); transition:all .15s; animation:vSI .16s ease; }
@keyframes vSI { from{opacity:0;transform:translateX(8px);}to{opacity:1;transform:translateX(0);} }
.oi:hover { border-color:var(--v-border-2); background:var(--v-white); }
.oi-em  { font-size:18px; flex-shrink:0; }
.oi-bod { flex:1; min-width:0; }
.oi-nm  { font-size:12px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.oi-un  { font-size:10.5px; color:var(--v-text-3); }
.qctrl  { display:flex; align-items:center; gap:4px; flex-shrink:0; }
.qbtn   { width:20px; height:20px; border-radius:4px; background:var(--v-white); border:1px solid var(--v-border); color:var(--v-text); cursor:pointer; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; transition:all .13s; }
.qbtn:hover { border-color:var(--v-primary); color:var(--v-primary); }
.qnum   { font-size:12px; font-weight:700; min-width:18px; text-align:center; }
.oi-tot { font-size:12px; font-weight:700; min-width:60px; text-align:right; flex-shrink:0; }
.btn-del { background:none; border:none; color:var(--v-text-3); cursor:pointer; font-size:14px; transition:color .13s; }
.btn-del:hover { color:var(--v-danger); }
/* bill */
.op-bill { padding:10px 14px; border-top:1px solid var(--v-border); flex-shrink:0; background:var(--v-bg); }
.br { display:flex; justify-content:space-between; font-size:12px; color:var(--v-text-2); padding:2.5px 0; }
.br .bv { font-weight:500; }
.br.disc .bv { color:var(--v-success); font-weight:700; }
.br.ptsd .bv { color:var(--v-warning); font-weight:700; }
.bdiv { height:1px; background:var(--v-border); margin:7px 0; }
.btot { display:flex; justify-content:space-between; align-items:center; }
.bt-l { font-size:13px; font-weight:700; color:var(--v-text); }
.bt-v { font-size:20px; font-weight:700; color:var(--v-primary); }
.earn-strip { display:flex; align-items:center; gap:7px; margin-top:8px; background:var(--v-warning-s); border:1px solid var(--v-warning-m); border-radius:var(--v-r); padding:7px 11px; }
.es-i { font-size:14px; }
.es-t { font-size:11.5px; font-weight:600; color:var(--v-warning); }
.es-s { font-size:10.5px; color:var(--v-text-2); }
/* actions */
.op-act { padding:10px 14px 12px; flex-shrink:0; border-top:1px solid var(--v-border); display:flex; flex-direction:column; gap:7px; }
.btn-pro { width:100%; padding:12px; border-radius:var(--v-rl); background:var(--v-primary); border:none; color:#fff; font-size:13.5px; font-weight:700; cursor:pointer; font-family:inherit; display:flex; align-items:center; justify-content:center; gap:7px; transition:all .18s; }
.btn-pro:hover { background:var(--v-primary-h); transform:translateY(-1px); box-shadow:0 4px 14px var(--v-primary-m); }
.btn-pro:active { transform:translateY(0); }
.btn-pro:disabled { opacity:.35; cursor:not-allowed; transform:none; box-shadow:none; }
.btn-pro i { font-size:16px; }
.btn-bk { width:100%; padding:9px; border-radius:var(--v-rm); background:none; border:1px solid var(--v-border); color:var(--v-text-2); font-size:12.5px; font-weight:600; cursor:pointer; font-family:inherit; transition:all .15s; display:flex; align-items:center; justify-content:center; gap:6px; }
.btn-bk:hover { background:var(--v-bg); border-color:var(--v-border-2); color:var(--v-text); }

/* ══ MODAL ══ */
.modal-ov { position:fixed; inset:0; background:rgba(33,37,41,.4); backdrop-filter:blur(3px); z-index:9999; display:none; align-items:center; justify-content:center; }
.modal-ov.show { display:flex; }
.modal-bx { background:var(--v-white); border-radius:var(--v-rl); padding:22px; box-shadow:var(--v-shlg); animation:vPop .22s cubic-bezier(.34,1.56,.64,1); width:400px; max-width:95vw; }
.modal-hd { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
.modal-ttl { font-size:15px; font-weight:700; color:var(--v-text); }
.btn-mc { width:26px; height:26px; border-radius:var(--v-r); background:var(--v-bg); border:1px solid var(--v-border); color:var(--v-text-2); cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center; transition:all .13s; }
.btn-mc:hover { color:var(--v-danger); border-color:var(--v-danger-m); }
.mf { margin-bottom:11px; }
.mf label { display:block; font-size:10.5px; font-weight:700; color:var(--v-text-2); margin-bottom:4px; text-transform:uppercase; letter-spacing:.8px; }
.mf input { width:100%; background:var(--v-bg); border:1px solid var(--v-border); border-radius:var(--v-rm); padding:9px 12px; font-size:13px; color:var(--v-text); font-family:inherit; outline:none; transition:border-color .15s; }
.mf input:focus { border-color:var(--v-success); box-shadow:0 0 0 3px var(--v-success-s); }
.mf input::placeholder { color:var(--v-text-3); }
.ibox { display:flex; align-items:flex-start; gap:7px; background:var(--v-info-s); border:1px solid rgba(41,156,219,.25); border-radius:var(--v-rm); padding:10px 12px; font-size:11.5px; color:var(--v-text-2); line-height:1.6; margin-bottom:14px; }
.ibox i { color:var(--v-info); flex-shrink:0; margin-top:1px; font-size:15px; }
.btn-reg { width:100%; padding:11px; border-radius:var(--v-rm); background:var(--v-success); border:none; color:#fff; font-size:13.5px; font-weight:700; cursor:pointer; font-family:inherit; display:flex; align-items:center; justify-content:center; gap:7px; transition:all .15s; }
.btn-reg:hover { background:var(--v-success-h); transform:translateY(-1px); box-shadow:0 4px 14px var(--v-success-m); }

/* ══ TOAST ══ */
.vtoast { position:fixed; bottom:20px; left:50%; transform:translateX(-50%) translateY(60px); background:var(--v-text); color:#fff; border-radius:var(--v-rm); padding:9px 16px; font-size:12.5px; font-weight:600; display:flex; align-items:center; gap:7px; z-index:99999; transition:transform .3s cubic-bezier(.34,1.56,.64,1); box-shadow:var(--v-shlg); white-space:nowrap; }
.vtoast.show { transform:translateX(-50%) translateY(0); }
.vtoast i { color:var(--v-success); font-size:14px; }
</style>
@endsection

@section('content')
<div class="trm">

  {{-- STEP BAR --}}
  <div class="trm-steps" id="stepBar">
    <div class="ts-item active" data-step="1" onclick="goStep(1)"><div class="ts-num">1</div><span class="ts-lbl">Menu</span></div>
    <div class="ts-sep"></div>
    <div class="ts-item" data-step="2" onclick="jumpStep(2)"><div class="ts-num">2</div><span class="ts-lbl">Loyalty Points</span></div>
    <div class="ts-sep"></div>
    <div class="ts-item" data-step="3" onclick="jumpStep(3)"><div class="ts-num">3</div><span class="ts-lbl">Voucher / Coupon</span></div>
    <div class="ts-sep"></div>
    <div class="ts-item" data-step="4" onclick="jumpStep(4)"><div class="ts-num">4</div><span class="ts-lbl">Payment</span></div>
    <div class="ts-sep"></div>
    <div class="ts-item" data-step="5"><div class="ts-num">5</div><span class="ts-lbl">Done</span></div>
  </div>

  {{-- MAIN --}}
  <div class="trm-main">

    {{-- PAGE 1 --}}
    <div class="trm-page active" id="pg1">
      <div class="pg-head">
        <div class="pg-title"><i class="ri-restaurant-line"></i> Select Items</div>
        <div class="pg-sub">Tap an item to add to the order. Tap again to increase quantity.</div>
      </div>
      <div class="pg-body">
        <div class="menu-sw">
          <div class="msbox">
            <i class="ri-search-line"></i>
            <input id="menuSearch" type="text" placeholder="Search menu items…" oninput="filterMenu(this.value)"/>
          </div>
        </div>
        <div class="cat-row">
          <button class="cpill on" onclick="filterCat('all',this)">All Items</button>
          <button class="cpill" onclick="filterCat('chicken',this)">🍗 Chicken</button>
          <button class="cpill" onclick="filterCat('meals',this)">🥡 Meals</button>
          <button class="cpill" onclick="filterCat('sides',this)">🍟 Sides</button>
          <button class="cpill" onclick="filterCat('drinks',this)">🥤 Drinks</button>
          <button class="cpill" onclick="filterCat('desserts',this)">🍦 Desserts</button>
        </div>
        <div id="menuContent"></div>
      </div>
    </div>

    {{-- PAGE 2 --}}
    <div class="trm-page" id="pg2">
      <div class="pg-head">
        <div class="pg-title"><i class="ri-vip-crown-line"></i> Loyalty Points</div>
        <div class="pg-sub">Look up the customer's VFM card to link their account and apply point redemption.</div>
      </div>
      <div class="pg-body">
        <div id="loyLookup">
          <div class="loy-row">
            <input class="loy-inp" id="loyInput" type="text" placeholder="Phone number, card no., or name…" onkeydown="if(event.key==='Enter')lookupCust()"/>
            <button class="btn-find" onclick="lookupCust()"><i class="ri-search-line"></i> Find</button>
            <button class="btn-skip" onclick="goStep(3)"><i class="ri-arrow-right-line"></i> Skip</button>
          </div>
          <div class="loy-empty">No customer linked yet &nbsp;·&nbsp; <span class="reg-lnk" onclick="openModal('regModal')">+ Register new customer</span></div>
        </div>
        <div id="loyFound" style="display:none">
          <div class="cust-card">
            <div class="cc-hd">
              <div class="cc-av" id="ccAv">SK</div>
              <div class="cc-info"><div class="cc-name" id="ccName">Sara Khan</div>
                <div class="cc-meta"><span id="ccPhone">0300-1234567</span><span class="cc-tier" id="ccTier">Gold</span><span id="ccCard">VFM-2024-8821</span></div>
              </div>
              <button class="cc-unlink" onclick="unlinkCust()"><i class="ri-close-line"></i></button>
            </div>
            <div class="cc-stats">
              <div class="cc-stat"><div class="cc-sl">Total Pts</div><div class="cc-sv warn" id="ccPtsTotal">12,450</div></div>
              <div class="cc-stat"><div class="cc-sl">Usable</div><div class="cc-sv" id="ccPtsUsable">5,000</div></div>
              <div class="cc-stat"><div class="cc-sl">Value (Rs.)</div><div class="cc-sv suc" id="ccPtsVal">500</div></div>
            </div>
          </div>
          <div class="pts-ch">
            <div class="pts-ch-ttl">Redeem loyalty points?</div>
            <div class="pts-ch-sub">Customer has <strong id="pcPtsAmt" style="color:var(--v-warning)">12,450 pts</strong> available. 10 pts = Rs. 1 discount.</div>
            <div class="pts-opts">
              <div class="pts-opt" id="optYes" onclick="choosePts(true)">
                <div class="pts-opt-ic">🪙</div><div class="pts-opt-t">Yes, redeem</div><div class="pts-opt-s" id="optYesSub">Up to 5,000 pts</div>
              </div>
              <div class="pts-opt" id="optNo" onclick="choosePts(false)">
                <div class="pts-opt-ic">➡️</div><div class="pts-opt-t">Skip</div><div class="pts-opt-s">Earn pts instead</div>
              </div>
            </div>
            <div class="pts-sl-sec" id="sliderSec">
              <div class="pts-sl-hd"><span class="ll">How many points?</span><span class="vv" id="sliderLabel">0 pts = Rs. 0</span></div>
              <input type="range" class="vrange" id="ptsSlider" min="0" max="5000" step="50" value="0" oninput="onSlider(this.value)" style="--pct:0%"/>
              <div class="pts-sl-lbr"><span>0</span><span id="sliderCur" style="color:var(--v-warning);font-weight:700">0 pts</span><span id="sliderMax">5,000 pts</span></div>
              <div class="pts-sum">
                <div><div class="ps-l">Points used</div><div class="ps-v" id="psrPts">0 pts</div></div>
                <div class="ps-d"></div>
                <div style="text-align:right"><div class="ps-l">Savings</div><div class="ps-s" id="psrSave">Rs. 0</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- PAGE 3 --}}
    <div class="trm-page" id="pg3">
      <div class="pg-head">
        <div class="pg-title"><i class="ri-coupon-line"></i> Voucher / Coupon</div>
        <div class="pg-sub">Apply a printed voucher code, or select a digital coupon linked to the customer's account.</div>
      </div>
      <div class="pg-body">
        <div class="v-info-box">
          <i class="ri-information-line"></i>
          <div><strong>Printed / SMS Voucher:</strong> Customer shows their voucher or SMS. Cashier reads the code and types it below — the system validates and applies the discount automatically.</div>
        </div>
        <div class="v-card">
          <div class="v-ttl">Enter Voucher Code</div>
          <div class="v-sub">Type the code from a printed voucher, SMS, or email.</div>
          <div class="v-irow">
            <input class="v-inp" id="voucherInput" type="text" placeholder="e.g. KFCVFM20" oninput="this.value=this.value.toUpperCase()"/>
            <button class="btn-ap" onclick="applyVoucher()">Apply</button>
          </div>
          <div id="voucherApplied" style="display:none">
            <div class="v-applied">
              <span class="va-ico">🎉</span>
              <div class="va-info"><div class="va-nm" id="vAppliedName">—</div><div class="va-sv" id="vAppliedSaving">Saving: Rs.0</div></div>
              <button class="btn-vrm" onclick="removeVoucher()"><i class="ri-close-circle-line"></i></button>
            </div>
          </div>
        </div>

        {{-- Customer digital coupons --}}
        <div id="custCoupSec" style="display:none">
          <div class="v-sec-lbl">
            <i class="ri-user-heart-line" style="font-size:12px;vertical-align:middle"></i>
            Customer's Digital Coupons
            <span class="v-cust-tag"><i class="ri-check-line"></i> Linked to account</span>
          </div>
          <div class="vlist" id="custCoupList"></div>
        </div>

        <div class="v-sec-lbl">Available Promotions</div>
        <div class="vlist">
          <div class="vrow" onclick="quickVoucher('KFCVFM20')"><div class="vbdg">KFCVFM20</div><div class="vinfo"><div class="vnm">VFM Welcome Offer</div><div class="vexp">Valid till 31 Mar 2026 · New members</div></div><div class="vdsc">20% OFF</div></div>
          <div class="vrow" onclick="quickVoucher('FLAT200')"><div class="vbdg">FLAT200</div><div class="vinfo"><div class="vnm">Rs.200 Flat Discount</div><div class="vexp">Valid till 15 Apr 2026 · Any order</div></div><div class="vdsc">−Rs.200</div></div>
          <div class="vrow" onclick="quickVoucher('EID30')"><div class="vbdg">EID30</div><div class="vinfo"><div class="vnm">Eid Celebration Special</div><div class="vexp">Valid till 04 Apr 2026 · Limited</div></div><div class="vdsc">30% OFF</div></div>
          <div class="vrow" onclick="quickVoucher('RAMADAN15')"><div class="vbdg">RAMADAN15</div><div class="vinfo"><div class="vnm">Ramadan Iftar Deal</div><div class="vexp">Valid till 30 Mar 2026</div></div><div class="vdsc">15% OFF</div></div>
        </div>
      </div>
    </div>

    {{-- PAGE 4 --}}
    <div class="trm-page" id="pg4">
      <div class="pg-head">
        <div class="pg-title"><i class="ri-secure-payment-line"></i> Payment</div>
        <div class="pg-sub">Choose how the customer will pay. All amounts in PKR.</div>
      </div>
      <div class="pg-body">
        <div class="pay-grid">
          <div class="popt sel" id="pm-cash" onclick="selPay('cash')"><div class="popt-ic">💵</div><div class="popt-nm">Cash</div><div class="popt-ds">Physical notes at counter</div></div>
          <div class="popt" id="pm-card" onclick="selPay('card')"><div class="popt-ic">💳</div><div class="popt-nm">Debit / Credit Card</div><div class="popt-ds">Visa, Mastercard, UnionPay</div></div>
          <div class="popt" id="pm-jazz" onclick="selPay('jazz')"><div class="popt-ic">📲</div><div class="popt-nm">JazzCash / EasyPaisa</div><div class="popt-ds">Mobile wallet QR / transfer</div></div>
          <div class="popt" id="pm-bank" onclick="selPay('bank')"><div class="popt-ic">🏦</div><div class="popt-nm">Bank Transfer</div><div class="popt-ds">IBFT / Raast</div></div>
        </div>
        <div class="pdet show" id="pd-cash">
          <div class="pd-ttl"><i class="ri-money-rupee-circle-line"></i>Cash Payment</div>
          <div class="dgrid">
            <button class="dbn" onclick="setDenom(100)">Rs.100</button>
            <button class="dbn" onclick="setDenom(500)">Rs.500</button>
            <button class="dbn" onclick="setDenom(1000)">Rs.1,000</button>
            <button class="dbn" onclick="setDenom(2000)">Rs.2,000</button>
            <button class="dbn" onclick="setDenom(5000)">Rs.5,000</button>
            <button class="dbn" onclick="setDenom(10000)">Rs.10,000</button>
            <button class="dbn full" onclick="setExact()">⚡ Set Exact Amount</button>
          </div>
          <div class="amt-wrap"><span class="amt-pre">Rs.</span><input class="fc pl" id="cashAmt" type="number" placeholder="Amount received" oninput="calcChange()"/></div>
          <div class="chg-row hidden" id="changeRow"><span class="chg-l">Change to return</span><span class="chg-v" id="changeVal">Rs.0</span></div>
        </div>
        <div class="pdet" id="pd-card">
          <div class="pd-ttl"><i class="ri-bank-card-line"></i>POS Machine — Card</div>
          <div class="frow">
            <div class="fg"><label class="fl">Card Type</label><select class="fc"><option>Visa</option><option>Mastercard</option><option>UnionPay</option><option>Amex</option></select></div>
            <div class="fg"><label class="fl">Transaction Ref. No.</label><input class="fc" type="text" placeholder="e.g. TRX-002841"/></div>
          </div>
          <div class="hint"><i class="ri-information-line"></i>Insert or tap card on POS machine then enter the approval code.</div>
        </div>
        <div class="pdet" id="pd-jazz">
          <div class="pd-ttl"><i class="ri-smartphone-line"></i>JazzCash / EasyPaisa</div>
          <div class="binfo">
            <div class="bir"><span class="bk">Merchant Name</span><span class="bv">KFC Saddar (VFM)</span></div>
            <div class="bir"><span class="bk">JazzCash No.</span><span class="bv bvc" onclick="toast('Number copied')">0312-1234567</span></div>
            <div class="bir"><span class="bk">EasyPaisa No.</span><span class="bv bvc" onclick="toast('Number copied')">0314-9876543</span></div>
            <div class="bir"><span class="bk">Amount Due</span><span class="bv" id="jazzDue">Rs.0</span></div>
          </div>
          <div class="fg"><label class="fl">Transaction ID (from customer's SMS)</label><input class="fc" type="text" placeholder="e.g. TXN-20260312-18291"/></div>
        </div>
        <div class="pdet" id="pd-bank">
          <div class="pd-ttl"><i class="ri-building-2-line"></i>Bank Transfer (IBFT / Raast)</div>
          <div class="binfo">
            <div class="bir"><span class="bk">Account Title</span><span class="bv">VFM Foods Pvt Ltd</span></div>
            <div class="bir"><span class="bk">Bank</span><span class="bv">Meezan Bank</span></div>
            <div class="bir"><span class="bk">Account No.</span><span class="bv bvc" onclick="toast('Copied')">0129-0104601234</span></div>
            <div class="bir"><span class="bk">IBAN</span><span class="bv bvc" onclick="toast('Copied')">PK36MEZN0001290104601234</span></div>
            <div class="bir"><span class="bk">Amount Due</span><span class="bv" id="bankDue">Rs.0</span></div>
          </div>
          <div class="frow">
            <div class="fg"><label class="fl">Sender's Bank</label><input class="fc" placeholder="e.g. HBL, UBL"/></div>
            <div class="fg"><label class="fl">Transaction Ref. No.</label><input class="fc" placeholder="From SMS"/></div>
          </div>
        </div>
      </div>
    </div>

    {{-- PAGE 5 --}}
    <div class="trm-page" id="pg5">
      <div class="rcpg">
        <div class="rc-ico">✅</div>
        <div class="rc-ttl">Payment Complete!</div>
        <div class="rc-sub" id="rcSub">Order processed successfully</div>
        <div class="pts-ebox" id="rcPtsBox" style="display:none">
          <div class="pe-i">🪙</div>
          <div><div class="pe-p" id="rcPtsNum">+0 pts</div><div class="pe-n" id="rcPtsName">Points credited</div><div class="pe-b" id="rcPtsBal">New balance: 0 pts</div></div>
        </div>
        <div class="rcbox" id="rcBox"></div>
        <div class="rc-acts">
          <button class="rc-btn out" onclick="toast('Sending to printer…')"><i class="ri-printer-line"></i> Print Receipt</button>
          <button class="rc-btn sol" onclick="newOrder()"><i class="ri-add-circle-line"></i> New Order</button>
        </div>
      </div>
    </div>

  </div>

  {{-- ORDER PANEL --}}
  <div class="order-panel">
    <div class="op-hd">
      <div class="op-l"><span class="op-ttl">Current Order</span><span class="op-cnt" id="opCount">0 items</span></div>
      <button class="btn-clr" onclick="clearOrder()"><i class="ri-delete-bin-line"></i> Clear</button>
    </div>
    <div class="op-items" id="orderItems">
      <div class="op-empty" id="orderEmpty"><div class="oei">🛒</div><p>No items · tap menu to add</p></div>
    </div>
    <div class="op-bill" id="billSection" style="display:none">
      <div class="br"><span>Subtotal</span><span class="bv" id="bSub">Rs.0</span></div>
      <div class="br disc" id="bDiscRow" style="display:none"><span>Voucher Discount</span><span class="bv" id="bDisc">−Rs.0</span></div>
      <div class="br ptsd" id="bPtsRow"  style="display:none"><span>Points Redeemed</span><span class="bv" id="bPts">−Rs.0</span></div>
      <div class="br"><span>Tax (16%)</span><span class="bv" id="bTax">Rs.0</span></div>
      <div class="bdiv"></div>
      <div class="btot"><span class="bt-l">Total</span><span class="bt-v" id="bTotal">Rs.0</span></div>
      <div class="earn-strip" id="earnStrip" style="display:none">
        <span class="es-i">🪙</span>
        <div><div class="es-t" id="earnNum">+0 pts will be earned</div><div class="es-s">Credited after payment</div></div>
      </div>
    </div>
    <div class="op-act" id="actionArea">
      <button class="btn-pro" id="proceedBtn" disabled onclick="proceed()"><i class="ri-add-circle-line"></i> Add items to continue</button>
    </div>
  </div>

</div>

{{-- REGISTER MODAL --}}
<div class="modal-ov" id="regModal">
  <div class="modal-bx">
    <div class="modal-hd"><span class="modal-ttl">Register New Customer</span><button class="btn-mc" onclick="closeModal('regModal')"><i class="ri-close-line"></i></button></div>
    <div class="mf"><label>Full Name *</label><input id="rName" placeholder="Customer full name"/></div>
    <div class="mf"><label>Phone Number *</label><input id="rPhone" type="tel" placeholder="03XXXXXXXXX"/></div>
    <div class="mf"><label>Email (Optional)</label><input id="rEmail" type="email" placeholder="email@example.com"/></div>
    <div class="mf"><label>Date of Birth (Optional)</label><input type="date" style="color-scheme:light"/></div>
    <div class="ibox"><i class="ri-information-line"></i>A VFM card is auto-generated. Credentials sent via SMS &amp; Email instantly.</div>
    <button class="btn-reg" onclick="doRegister()"><i class="ri-user-add-line"></i> Register &amp; Create VFM Card</button>
  </div>
</div>

<div class="vtoast" id="vToast"><i class="ri-check-circle-fill"></i><span id="vToastMsg">Done</span></div>
@endsection

@section('page-wise-scripts')
<script>
const MENU=[
  {n:'Zinger Burger',e:'🍔',p:520,c:'chicken'},{n:'Zinger Stacker',e:'🍔',p:720,c:'chicken'},
  {n:'Crispy Strips 3pc',e:'🍗',p:480,c:'chicken'},{n:'Hot & Crispy 2pc',e:'🍗',p:420,c:'chicken'},
  {n:'Chicken Fillet',e:'🍗',p:380,c:'chicken'},{n:'Zinger Meal',e:'🥡',p:850,c:'meals'},
  {n:'Family Bucket',e:'🪣',p:2500,c:'meals'},{n:'Mighty Meal',e:'🥡',p:1100,c:'meals'},
  {n:'Twister Meal',e:'🥡',p:950,c:'meals'},{n:'French Fries Reg',e:'🍟',p:220,c:'sides'},
  {n:'French Fries Lrg',e:'🍟',p:280,c:'sides'},{n:'Coleslaw',e:'🥗',p:150,c:'sides'},
  {n:'Corn Cob',e:'🌽',p:180,c:'sides'},{n:'Garlic Bread',e:'🧄',p:160,c:'sides'},
  {n:'Pepsi Regular',e:'🥤',p:120,c:'drinks'},{n:'Pepsi Large',e:'🥤',p:180,c:'drinks'},
  {n:'Mineral Water',e:'💧',p:80,c:'drinks'},{n:'Frooti',e:'🧃',p:100,c:'drinks'},
  {n:'Shake Vanilla',e:'🥛',p:240,c:'drinks'},{n:'Soft Serve',e:'🍦',p:120,c:'desserts'},
  {n:'Choc Mousse',e:'🍫',p:200,c:'desserts'},{n:'Brownie',e:'🍩',p:180,c:'desserts'},
];
const CATS={chicken:'🍗 Chicken',meals:'🥡 Meals',sides:'🍟 Sides',drinks:'🥤 Drinks',desserts:'🍦 Desserts'};
const VOUCHERS={
  'KFCVFM20':{label:'20% OFF — VFM Welcome',type:'pct',val:.2},
  'FLAT200'  :{label:'Rs.200 Flat Discount', type:'flat',val:200},
  'EID30'    :{label:'30% OFF — Eid Special',type:'pct',val:.3},
  'RAMADAN15':{label:'15% Ramadan Special',  type:'pct',val:.15},
  'SARA10'   :{label:"10% — Sara's Birthday",type:'pct',val:.10},
  'SARAGIFT' :{label:'Rs.150 Gift Coupon',   type:'flat',val:150},
};
/* Simulated per-customer coupons — in real app fetched via AJAX for linked customer */
const CUST_COUPONS={
  'SARA10'  :{label:'Birthday Discount',disc:'10% OFF',  exp:'Valid till 20 Apr 2026',code:'SARA10'  },
  'SARAGIFT':{label:'Gift Coupon',      disc:'−Rs.150',  exp:'Valid till 30 Apr 2026',code:'SARAGIFT'},
};

let order=[],custLinked=false,custData=null;
let voucherDsc=0,voucherLabel='';
let ptsDsc=0,ptsUsed=0;
let curStep=1,activePay='cash';
let orderSeq=Math.floor(Math.random()*9000)+1000;

/* MENU */
function renderMenu(items){
  let html='',lastCat='';
  items.forEach(it=>{
    if(it.c!==lastCat){if(lastCat)html+='</div>';html+=`<div class="msec-lbl">${CATS[it.c]||it.c}</div><div class="mgrid">`;lastCat=it.c;}
    const inO=order.find(o=>o.n===it.n);const qty=inO?inO.qty:0;
    html+=`<div class="mitem${qty?' inorder':''}" onclick="addItem('${it.n}','${it.e}',${it.p})">
      <div class="mi-qbadge">${qty||''}</div>
      <div class="mi-em">${it.e}</div>
      <div class="mi-nm">${it.n}</div>
      <div class="mi-ft">
        <span class="mi-pr">Rs.${it.p.toLocaleString()}</span>
        <button class="mi-ab" onclick="event.stopPropagation();addItem('${it.n}','${it.e}',${it.p})"><i class="ri-add-line"></i></button>
      </div></div>`;
  });
  if(items.length&&lastCat)html+='</div>';
  else if(!items.length)html='<div style="text-align:center;padding:40px;color:var(--v-text-3)">No items found 🔍</div>';
  document.getElementById('menuContent').innerHTML=html;
}
renderMenu(MENU);
function filterCat(cat,btn){document.querySelectorAll('.cpill').forEach(b=>b.classList.remove('on'));btn.classList.add('on');document.getElementById('menuSearch').value='';renderMenu(cat==='all'?MENU:MENU.filter(i=>i.c===cat));}
function filterMenu(q){renderMenu(q?MENU.filter(i=>i.n.toLowerCase().includes(q.toLowerCase())):MENU);}

/* ORDER */
function addItem(n,e,p){const ex=order.find(i=>i.n===n);if(ex)ex.qty++;else order.push({n,e,p,qty:1});renderOrder();renderMenu(MENU);toast(`${e} ${n} added`);}
function chQty(i,d){order[i].qty+=d;if(order[i].qty<=0)order.splice(i,1);renderOrder();renderMenu(MENU);}
function delItem(i){const nm=order[i].n;order.splice(i,1);renderOrder();renderMenu(MENU);toast('Removed: '+nm);}
function clearOrder(){if(!order.length)return;order=[];voucherDsc=0;ptsDsc=0;ptsUsed=0;renderOrder();renderMenu(MENU);toast('Order cleared');}
function renderOrder(){
  const list=document.getElementById('orderItems'),empty=document.getElementById('orderEmpty'),bill=document.getElementById('billSection'),btn=document.getElementById('proceedBtn');
  document.getElementById('opCount').textContent=order.length+' item'+(order.length!==1?'s':'');
  if(!order.length){list.innerHTML='';list.appendChild(empty);empty.style.display='flex';bill.style.display='none';btn.disabled=true;btn.innerHTML='<i class="ri-add-circle-line"></i> Add items to continue';return;}
  empty.style.display='none';bill.style.display='block';btn.disabled=false;
  list.innerHTML=order.map((it,i)=>`
    <div class="oi"><span class="oi-em">${it.e}</span>
      <div class="oi-bod"><div class="oi-nm">${it.n}</div><div class="oi-un">Rs.${it.p.toLocaleString()} each</div></div>
      <div class="qctrl"><button class="qbtn" onclick="chQty(${i},-1)">−</button><span class="qnum">${it.qty}</span><button class="qbtn" onclick="chQty(${i},1)">+</button></div>
      <span class="oi-tot">Rs.${(it.p*it.qty).toLocaleString()}</span>
      <button class="btn-del" onclick="delItem(${i})"><i class="ri-delete-bin-line"></i></button>
    </div>`).join('');
  calcBill();
}

/* BILL */
function calcBill(){
  const sub=order.reduce((s,i)=>s+i.p*i.qty,0);
  const afVD=Math.max(0,sub-voucherDsc);const afPts=Math.max(0,afVD-ptsDsc);
  const tax=Math.round(afPts*.16);const total=afPts+tax;
  const pts=custLinked?Math.floor(sub/10)*2:0;
  document.getElementById('bSub').textContent='Rs.'+sub.toLocaleString();
  document.getElementById('bTax').textContent='Rs.'+tax.toLocaleString();
  document.getElementById('bTotal').textContent='Rs.'+total.toLocaleString();
  document.getElementById('bDiscRow').style.display=voucherDsc?'flex':'none';
  document.getElementById('bDisc').textContent='−Rs.'+voucherDsc.toLocaleString();
  document.getElementById('bPtsRow').style.display=ptsDsc?'flex':'none';
  document.getElementById('bPts').textContent='−Rs.'+ptsDsc.toLocaleString();
  const es=document.getElementById('earnStrip');es.style.display=custLinked&&sub?'flex':'none';
  document.getElementById('earnNum').textContent='+'+pts+' pts will be earned';
  const ts='Rs.'+total.toLocaleString();
  ['jazzDue','bankDue'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=ts;});
  return{sub,tax,total,pts};
}

/* STEPS */
function goStep(n){
  if(n>1&&!order.length){toast('Add items before proceeding');return;}
  curStep=n;
  for(let i=1;i<=5;i++){const pg=document.getElementById('pg'+i);if(pg)pg.classList.toggle('active',i===n);}
  document.querySelectorAll('.ts-item').forEach(el=>{const s=parseInt(el.dataset.step);el.classList.toggle('active',s===n);el.classList.toggle('done',s<n);});
  updateProceedBtn();
}
function jumpStep(n){if(n<=curStep)goStep(n);}
function proceed(){
  if(curStep===1){if(!order.length){toast('Add at least one item');return;}goStep(2);}
  else if(curStep===2)goStep(3);
  else if(curStep===3)goStep(4);
  else if(curStep===4)doCheckout();
}
function updateProceedBtn(){
  const btn=document.getElementById('proceedBtn'),area=document.getElementById('actionArea');
  if(!order.length){btn.disabled=true;btn.innerHTML='<i class="ri-add-circle-line"></i> Add items to continue';const old=area.querySelector('.btn-bk');if(old)old.remove();return;}
  btn.disabled=false;
  const labels={1:'<i class="ri-arrow-right-circle-fill"></i> Continue to Loyalty Points',2:'<i class="ri-arrow-right-circle-fill"></i> Continue to Voucher',3:'<i class="ri-arrow-right-circle-fill"></i> Continue to Payment',4:'<i class="ri-check-double-line"></i> Process Payment'};
  btn.innerHTML=labels[curStep]||'Continue';btn.style.display=curStep===5?'none':'flex';
  const old=area.querySelector('.btn-bk');if(old)old.remove();
  if(curStep>1&&curStep<5){const bk=document.createElement('button');bk.className='btn-bk';bk.innerHTML='<i class="ri-arrow-left-line"></i> Back';bk.onclick=()=>goStep(curStep-1);area.appendChild(bk);}
}

/* CUSTOMER */
function lookupCust(){
  const v=document.getElementById('loyInput').value.trim();
  if(!v||v.length<3){toast('Enter at least 3 characters');return;}
  linkCust({name:'Sara Khan',phone:'0300-1234567',card:'VFM-2024-8821',pts:12450,usable:5000,tier:'Gold',av:'SK'});
}
function linkCust(d){
  custLinked=true;custData=d;
  document.getElementById('loyLookup').style.display='none';
  document.getElementById('loyFound').style.display='block';
  document.getElementById('ccAv').textContent=d.av;document.getElementById('ccName').textContent=d.name;
  document.getElementById('ccPhone').textContent=d.phone;document.getElementById('ccTier').textContent=d.tier;
  document.getElementById('ccCard').textContent=d.card;document.getElementById('ccPtsTotal').textContent=d.pts.toLocaleString();
  document.getElementById('ccPtsUsable').textContent=d.usable.toLocaleString();document.getElementById('ccPtsVal').textContent=Math.floor(d.usable/10).toLocaleString();
  document.getElementById('pcPtsAmt').textContent=d.pts.toLocaleString()+' pts';document.getElementById('optYesSub').textContent='Up to '+d.usable.toLocaleString()+' pts';
  document.getElementById('sliderMax').textContent=d.usable.toLocaleString()+' pts';document.getElementById('ptsSlider').max=d.usable;
  renderCustCoupons();calcBill();toast('✓ Customer linked: '+d.name);
}
function unlinkCust(){
  custLinked=false;custData=null;ptsDsc=0;ptsUsed=0;
  document.getElementById('loyFound').style.display='none';document.getElementById('loyLookup').style.display='block';
  document.getElementById('loyInput').value='';document.getElementById('ptsSlider').value=0;onSlider(0);
  document.getElementById('sliderSec').classList.remove('show');document.getElementById('optYes').className='pts-opt';document.getElementById('optNo').className='pts-opt';
  document.getElementById('custCoupSec').style.display='none';calcBill();toast('Customer unlinked');
}
function renderCustCoupons(){
  const sec=document.getElementById('custCoupSec'),list=document.getElementById('custCoupList');
  if(!custLinked||!custData){sec.style.display='none';return;}
  const coupons=Object.values(CUST_COUPONS);
  if(!coupons.length){sec.style.display='none';return;}
  list.innerHTML=coupons.map(c=>`<div class="vrow linked" onclick="quickVoucher('${c.code}')"><div class="vbdg">${c.code}</div><div class="vinfo"><div class="vnm">${c.label}</div><div class="vexp">${c.exp}</div></div><div class="vdsc">${c.disc}</div></div>`).join('');
  sec.style.display='block';
}

/* PTS SLIDER */
function choosePts(yes){
  document.getElementById('optYes').className='pts-opt'+(yes?' yes':'');
  document.getElementById('optNo').className='pts-opt'+(!yes?' no':'');
  document.getElementById('sliderSec').classList.toggle('show',yes);
  if(!yes){ptsDsc=0;ptsUsed=0;document.getElementById('ptsSlider').value=0;onSlider(0);calcBill();}
}
function onSlider(v){
  const pts=parseInt(v)||0;const disc=Math.floor(pts/10);ptsDsc=disc;ptsUsed=pts;
  const max=custData?custData.usable:5000;const pct=(pts/max*100).toFixed(1);
  document.getElementById('ptsSlider').style.setProperty('--pct',pct+'%');
  document.getElementById('sliderLabel').textContent=pts.toLocaleString()+' pts = Rs.'+disc.toLocaleString();
  document.getElementById('sliderCur').textContent=pts.toLocaleString()+' pts';
  document.getElementById('psrPts').textContent=pts.toLocaleString()+' pts';
  document.getElementById('psrSave').textContent='Rs. '+disc.toLocaleString();
  calcBill();
}

/* VOUCHER */
function applyVoucher(){applyCode(document.getElementById('voucherInput').value.trim().toUpperCase());}
function quickVoucher(code){document.getElementById('voucherInput').value=code;applyCode(code);}
function applyCode(code){
  const sub=order.reduce((s,i)=>s+i.p*i.qty,0);
  if(!sub){toast('Add items to the order first');return;}if(!code){toast('Enter a voucher code');return;}
  if(!VOUCHERS[code]){toast('Invalid or expired voucher code');return;}
  const v=VOUCHERS[code];voucherDsc=v.type==='pct'?Math.floor(sub*v.val):Math.min(v.val,sub);voucherLabel=v.label;
  document.getElementById('voucherApplied').style.display='block';
  document.getElementById('vAppliedName').textContent=v.label;document.getElementById('vAppliedSaving').textContent='Saving: Rs.'+voucherDsc.toLocaleString();
  calcBill();toast('✓ Voucher applied: '+v.label);
}
function removeVoucher(){voucherDsc=0;voucherLabel='';document.getElementById('voucherApplied').style.display='none';document.getElementById('voucherInput').value='';calcBill();toast('Voucher removed');}

/* PAYMENT */
function selPay(type){
  document.querySelectorAll('.popt').forEach(c=>c.classList.remove('sel'));document.getElementById('pm-'+type).classList.add('sel');activePay=type;
  ['cash','card','jazz','bank'].forEach(t=>{const d=document.getElementById('pd-'+t);if(d)d.classList.toggle('show',t===type);});
}
function setDenom(v){document.getElementById('cashAmt').value=v;calcChange();}
function setExact(){const{total}=calcBill();document.getElementById('cashAmt').value=total;calcChange();}
function calcChange(){
  const got=parseInt(document.getElementById('cashAmt').value)||0,{total}=calcBill(),row=document.getElementById('changeRow');
  if(got>=total&&total>0){row.classList.remove('hidden');document.getElementById('changeVal').textContent='Rs.'+(got-total).toLocaleString();}
  else row.classList.add('hidden');
}

/* CHECKOUT */
function doCheckout(){
  if(!order.length){toast('No items in order');return;}
  if(activePay==='cash'){const got=parseInt(document.getElementById('cashAmt').value)||0,{total}=calcBill();if(got<total){toast('Cash received is less than the total');return;}}
  const{sub,tax,total,pts}=calcBill();
  document.getElementById('rcSub').textContent=order.length+' item(s) · Order #'+(++orderSeq);
  if(pts>0&&custLinked&&custData){
    document.getElementById('rcPtsBox').style.display='flex';document.getElementById('rcPtsNum').textContent='+'+pts+' pts';
    document.getElementById('rcPtsName').textContent='Credited to '+custData.name+"'s VFM Card";
    document.getElementById('rcPtsBal').textContent='New balance: '+(custData.pts-ptsUsed+pts).toLocaleString()+' pts';
  }else document.getElementById('rcPtsBox').style.display='none';
  let rh=order.map(it=>`<div class="rcr"><span>${it.e} ${it.n} ×${it.qty}</span><span class="rv">Rs.${(it.p*it.qty).toLocaleString()}</span></div>`).join('');
  rh+=`<div class="rcr"><span>Subtotal</span><span class="rv">Rs.${sub.toLocaleString()}</span></div>`;
  if(voucherDsc)rh+=`<div class="rcr"><span>Voucher</span><span class="rv" style="color:var(--v-success)">−Rs.${voucherDsc.toLocaleString()}</span></div>`;
  if(ptsDsc)rh+=`<div class="rcr"><span>Points Redeemed</span><span class="rv" style="color:var(--v-warning)">−Rs.${ptsDsc.toLocaleString()}</span></div>`;
  rh+=`<div class="rcr"><span>Tax (16%)</span><span class="rv">Rs.${tax.toLocaleString()}</span></div>`;
  rh+=`<div class="rcr tot"><span>Total Paid</span><span class="rv">Rs.${total.toLocaleString()}</span></div>`;
  const pl={cash:'Cash',card:'Card (POS)',jazz:'JazzCash / EasyPaisa',bank:'Bank Transfer'};
  rh+=`<div class="rcr" style="margin-top:8px;padding-top:8px;border-top:1px solid var(--v-border)"><span>Payment via</span><span class="rv">${pl[activePay]}</span></div>`;
  if(activePay==='cash'){const got=parseInt(document.getElementById('cashAmt').value)||0;rh+=`<div class="rcr"><span>Cash Received</span><span class="rv">Rs.${got.toLocaleString()}</span></div><div class="rcr"><span>Change</span><span class="rv" style="color:var(--v-success)">Rs.${(got-total).toLocaleString()}</span></div>`;}
  document.getElementById('rcBox').innerHTML=rh;goStep(5);
}

/* NEW ORDER */
function newOrder(){
  order=[];voucherDsc=0;voucherLabel='';ptsDsc=0;ptsUsed=0;custLinked=false;custData=null;
  document.getElementById('cashAmt').value='';document.getElementById('voucherInput').value='';
  document.getElementById('voucherApplied').style.display='none';
  document.getElementById('loyFound').style.display='none';document.getElementById('loyLookup').style.display='block';
  document.getElementById('loyInput').value='';document.getElementById('ptsSlider').value=0;onSlider(0);
  document.getElementById('sliderSec').classList.remove('show');document.getElementById('optYes').className='pts-opt';document.getElementById('optNo').className='pts-opt';
  document.getElementById('changeRow').classList.add('hidden');document.getElementById('custCoupSec').style.display='none';
  renderOrder();renderMenu(MENU);goStep(1);
}

/* MODAL */
function openModal(id){document.getElementById(id).classList.add('show');}
function closeModal(id){document.getElementById(id).classList.remove('show');}
function doRegister(){
  const name=document.getElementById('rName').value.trim(),phone=document.getElementById('rPhone').value.trim();
  if(!name){toast('Enter customer name');return;}if(phone.length<10){toast('Enter a valid phone number');return;}
  closeModal('regModal');
  const av=name.split(' ').map(w=>w[0]).join('').slice(0,2).toUpperCase();
  linkCust({name,phone,card:'VFM-NEW-'+Math.floor(Math.random()*9000+1000),pts:500,usable:500,tier:'Silver',av});
  toast('✓ Registered! 500 welcome points. SMS sent to '+phone);
}

/* TOAST */
function toast(msg){const el=document.getElementById('vToast');document.getElementById('vToastMsg').textContent=msg;el.classList.add('show');clearTimeout(el._t);el._t=setTimeout(()=>el.classList.remove('show'),2600);}

renderOrder();updateProceedBtn();
</script>
@endsection





















{{-- @extends('layouts.master')

@section('title')
<title>Cashier Terminal | AccessMaster</title>
@endsection

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet"/>
<style>
/* ══ SCOPE ALL TERMINAL STYLES ══ */
.terminal-root {
  --t-bg:#f5f2ed;
  --t-white:#ffffff;
  --t-card:#faf9f7;
  --t-border:#e8e2d9;
  --t-border-dark:#d4ccc0;
  --t-text:#1c1814;
  --t-text-2:#6b6256;
  --t-text-3:#a89e92;
  --t-accent:#d4500a;
  --t-accent-h:#b8420a;
  --t-accent-soft:rgba(212,80,10,.08);
  --t-accent-mid:rgba(212,80,10,.18);
  --t-accent-glow:0 4px 24px rgba(212,80,10,.18);
  --t-green:#16a34a;
  --t-green-soft:rgba(22,163,74,.08);
  --t-green-mid:rgba(22,163,74,.2);
  --t-gold:#b45309;
  --t-gold-soft:rgba(180,83,9,.08);
  --t-gold-mid:rgba(180,83,9,.2);
  --t-blue:#1d4ed8;
  --t-blue-soft:rgba(29,78,216,.08);
  --t-blue-mid:rgba(29,78,216,.18);
  --t-red:#dc2626;
  --t-red-soft:rgba(220,38,38,.08);
  --t-shsm:0 1px 3px rgba(28,24,20,.06),0 1px 2px rgba(28,24,20,.04);
  --t-sh:0 4px 12px rgba(28,24,20,.08),0 2px 4px rgba(28,24,20,.04);
  --t-shlg:0 16px 40px rgba(28,24,20,.12),0 4px 12px rgba(28,24,20,.06);
  --t-r:10px;--t-rsm:7px;--t-rlg:14px;--t-rxl:20px;

  font-family:'Plus Jakarta Sans',sans-serif;
  background:var(--t-bg);
  color:var(--t-text);
  display:grid;
  /* Velzon topbar ~70px + velzon step-style subheader we don't use */
  height:calc(100vh - 70px);
  grid-template-rows:52px 1fr;
  grid-template-columns:1fr 360px;
  overflow:hidden;
  position:relative;
}

/* ══ Override Velzon page-content padding ══ */
.page-content { padding: 0 !important; }

/* ══ SCROLLBARS ══ */
.terminal-root *::-webkit-scrollbar{width:4px}
.terminal-root *::-webkit-scrollbar-thumb{background:var(--t-border-dark);border-radius:2px}

/* ══ STEP BAR ══ */
.t-stepbar{
  grid-column:1/-1;background:var(--t-white);
  border-bottom:1px solid var(--t-border);
  display:flex;align-items:center;padding:0 20px;gap:0;
  overflow-x:auto;box-shadow:var(--t-shsm);flex-shrink:0;
}
.t-stepbar::-webkit-scrollbar{display:none}
.t-si{display:flex;align-items:center;gap:9px;padding:0 16px 0 0;cursor:pointer;opacity:.42;flex-shrink:0;transition:opacity .2s}
.t-si.active{opacity:1}
.t-si.done{opacity:.72}
.t-si.done:hover{opacity:1}
.t-snum{width:26px;height:26px;border-radius:50%;border:2px solid var(--t-border-dark);background:var(--t-white);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;color:var(--t-text-2);flex-shrink:0;transition:all .25s}
.t-si.active .t-snum{background:var(--t-accent);border-color:var(--t-accent);color:#fff;box-shadow:var(--t-accent-glow)}
.t-si.done .t-snum{background:var(--t-green);border-color:var(--t-green);color:#fff}
.t-slbl{font-size:12.5px;font-weight:600;white-space:nowrap}
.t-scon{width:24px;height:2px;background:var(--t-border);flex-shrink:0;border-radius:1px;margin:0}
.t-si.done + .t-scon{background:var(--t-green-mid)}

/* ══ MAIN AREA ══ */
.t-main{overflow:hidden;display:flex;flex-direction:column;background:var(--t-bg)}

/* ══ PAGE ══ */
.t-page{display:none;flex-direction:column;height:100%;overflow:hidden;animation:tFU .22s ease}
.t-page.active{display:flex}
@keyframes tFU{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
.t-ph{padding:14px 20px 10px;flex-shrink:0}
.t-ptitle{font-family:'Instrument Serif',serif;font-size:21px;font-weight:400;color:var(--t-text);letter-spacing:-.3px}
.t-psub{font-size:12.5px;color:var(--t-text-2);margin-top:2px}
.t-pb{flex:1;overflow-y:auto;padding:0 20px 20px}

/* ═══ PAGE 1 MENU ═══ */
.t-srow{display:flex;gap:8px;margin-bottom:14px}
.t-sbox{flex:1;display:flex;align-items:center;gap:8px;background:var(--t-white);border:1.5px solid var(--t-border);border-radius:var(--t-r);padding:0 12px;transition:border-color .2s;box-shadow:var(--t-shsm)}
.t-sbox:focus-within{border-color:var(--t-accent)}
.t-sbox i{color:var(--t-text-3);font-size:15px;flex-shrink:0}
.t-sbox input{flex:1;border:none;background:none;outline:none;padding:9px 0;font-size:13.5px;color:var(--t-text);font-family:'Plus Jakarta Sans',sans-serif}
.t-sbox input::placeholder{color:var(--t-text-3)}
.t-catrow{display:flex;gap:6px;margin-bottom:14px;overflow-x:auto;flex-wrap:nowrap}
.t-catrow::-webkit-scrollbar{display:none}
.t-cpill{padding:5px 14px;border-radius:20px;border:1.5px solid var(--t-border);background:var(--t-white);color:var(--t-text-2);font-size:12px;font-weight:600;cursor:pointer;white-space:nowrap;transition:all .15s;font-family:inherit;box-shadow:var(--t-shsm)}
.t-cpill:hover{border-color:var(--t-border-dark);color:var(--t-text)}
.t-cpill.on{background:var(--t-accent);border-color:var(--t-accent);color:#fff;box-shadow:var(--t-accent-glow)}
.t-cslbl{font-size:10.5px;font-weight:800;letter-spacing:1.8px;text-transform:uppercase;color:var(--t-text-3);margin:16px 0 9px;padding-bottom:8px;border-bottom:1px solid var(--t-border)}
.t-mgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(148px,1fr));gap:9px;margin-bottom:4px}
.t-mi{background:var(--t-white);border:1.5px solid var(--t-border);border-radius:var(--t-rlg);padding:14px 12px;cursor:pointer;transition:all .2s;position:relative;overflow:hidden;user-select:none;box-shadow:var(--t-shsm)}
.t-mi:hover{border-color:var(--t-accent-mid);transform:translateY(-2px);box-shadow:var(--t-sh),var(--t-accent-glow)}
.t-mi:active{transform:scale(.97)}
.t-mi-shine{position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--t-accent),#f97316);opacity:0;transition:opacity .2s;border-radius:var(--t-rlg) var(--t-rlg) 0 0}
.t-mi:hover .t-mi-shine{opacity:1}
.t-mi-badge{position:absolute;top:8px;right:8px;width:20px;height:20px;border-radius:50%;background:var(--t-accent);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center}
.t-mi-em{font-size:28px;margin-bottom:9px}
.t-mi-name{font-size:12.5px;font-weight:700;color:var(--t-text);line-height:1.35;margin-bottom:8px}
.t-mi-foot{display:flex;align-items:center;justify-content:space-between}
.t-mi-price{font-size:13px;font-weight:700;color:var(--t-accent)}
.t-mi-add{width:25px;height:25px;border-radius:6px;background:var(--t-accent-soft);border:1.5px solid var(--t-accent-mid);color:var(--t-accent);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;transition:all .15s;flex-shrink:0}
.t-mi-add:hover{background:var(--t-accent);color:#fff}

/* ═══ PAGE 2 LOYALTY ═══ */
.t-lrow{display:flex;gap:8px;margin-bottom:18px}
.t-linp{flex:1;background:var(--t-white);border:1.5px solid var(--t-border);border-radius:var(--t-r);padding:10px 14px;font-size:13.5px;color:var(--t-text);font-family:inherit;outline:none;transition:border-color .2s;box-shadow:var(--t-shsm)}
.t-linp:focus{border-color:var(--t-green)}
.t-linp::placeholder{color:var(--t-text-3)}
.t-btnfind{padding:10px 18px;border-radius:var(--t-r);background:var(--t-green);border:none;color:#fff;font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s;display:flex;align-items:center;gap:6px;white-space:nowrap}
.t-btnfind:hover{background:#15803d;transform:translateY(-1px)}
.t-btnskip{padding:10px 14px;border-radius:var(--t-r);border:1.5px solid var(--t-border);background:var(--t-white);color:var(--t-text-2);font-size:12.5px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .15s;display:flex;align-items:center;gap:5px;white-space:nowrap}
.t-btnskip:hover{background:var(--t-card);border-color:var(--t-border-dark);color:var(--t-text)}
/* customer card */
.t-cc{background:var(--t-white);border:2px solid var(--t-green-mid);border-radius:var(--t-rlg);overflow:hidden;margin-bottom:18px;box-shadow:var(--t-sh),0 0 0 4px var(--t-green-soft);animation:tPop .25s cubic-bezier(.34,1.56,.64,1)}
@keyframes tPop{from{opacity:0;transform:scale(.93)}to{opacity:1;transform:scale(1)}}
.t-cc-hd{padding:16px 18px;display:flex;align-items:center;gap:13px;background:linear-gradient(135deg,#f0fdf4,#dcfce7)}
.t-cc-av{width:46px;height:46px;border-radius:50%;flex-shrink:0;background:linear-gradient(135deg,var(--t-green),#059669);display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:#fff;box-shadow:0 3px 10px rgba(22,163,74,.3)}
.t-cc-info{flex:1}
.t-cc-name{font-size:15px;font-weight:800;color:var(--t-text)}
.t-cc-meta{font-size:12px;color:var(--t-text-2);margin-top:2px;display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.t-tier{background:var(--t-gold-soft);color:var(--t-gold);border:1px solid var(--t-gold-mid);border-radius:5px;padding:1px 7px;font-size:10.5px;font-weight:800}
.t-cc-unlink{background:none;border:none;color:var(--t-text-3);cursor:pointer;font-size:20px;transition:color .15s}
.t-cc-unlink:hover{color:var(--t-red)}
.t-cc-pts{display:grid;grid-template-columns:1fr 1fr 1fr;border-top:1px solid var(--t-green-mid)}
.t-cc-pt{padding:13px 16px;border-right:1px solid var(--t-green-mid)}
.t-cc-pt:last-child{border-right:none}
.t-cc-pl{font-size:10.5px;color:var(--t-text-2);margin-bottom:3px;text-transform:uppercase;letter-spacing:.8px;font-weight:600}
.t-cc-pv{font-size:15px;font-weight:800;color:var(--t-text)}
.t-cc-pv.gold{color:var(--t-gold)}
/* pts choice */
.t-ptsc{background:var(--t-white);border:1.5px solid var(--t-border);border-radius:var(--t-rlg);padding:20px;box-shadow:var(--t-sh)}
.t-ptsc-ttl{font-size:14px;font-weight:700;margin-bottom:4px}
.t-ptsc-sub{font-size:12.5px;color:var(--t-text-2);margin-bottom:18px;line-height:1.6}
.t-optrow{display:flex;gap:10px;margin-bottom:18px}
.t-opt{flex:1;padding:14px;border-radius:var(--t-rlg);border:2px solid var(--t-border);background:var(--t-card);cursor:pointer;text-align:center;transition:all .2s;user-select:none}
.t-opt:hover{border-color:var(--t-border-dark);background:var(--t-white)}
.t-opt.syes{border-color:var(--t-green);background:var(--t-green-soft);box-shadow:0 0 0 3px rgba(22,163,74,.12)}
.t-opt.sno{border-color:var(--t-accent);background:var(--t-accent-soft)}
.t-oi-c{font-size:26px;margin-bottom:7px}
.t-oi-t{font-size:13px;font-weight:800}
.t-oi-s{font-size:11px;color:var(--t-text-2);margin-top:2px}
/* slider */
.t-slsec{display:none;animation:tFU .2s ease}
.t-slsec.show{display:block}
.t-slhd{display:flex;justify-content:space-between;align-items:center;margin-bottom:10px}
.t-slhd .sl{font-size:12.5px;color:var(--t-text-2)}
.t-slhd .sv{font-size:14px;font-weight:800;color:var(--t-gold)}
input[type=range].t-range{-webkit-appearance:none;width:100%;height:6px;border-radius:3px;background:linear-gradient(90deg,var(--t-gold) var(--pct,0%),var(--t-border) var(--pct,0%));outline:none;cursor:pointer;margin-bottom:8px}
input[type=range].t-range::-webkit-slider-thumb{-webkit-appearance:none;width:20px;height:20px;border-radius:50%;background:var(--t-gold);border:3px solid var(--t-white);box-shadow:0 2px 8px rgba(180,83,9,.3);cursor:pointer}
.t-rlbls{display:flex;justify-content:space-between;font-size:11px;color:var(--t-text-3);margin-bottom:14px}
.t-psum{display:flex;align-items:center;justify-content:space-between;background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1.5px solid var(--t-gold-mid);border-radius:var(--t-r);padding:12px 16px}
.t-psl{font-size:11px;color:var(--t-text-2)}
.t-psv{font-size:16px;font-weight:800;color:var(--t-gold)}
.t-psdiv{width:1px;height:36px;background:var(--t-gold-mid)}
.t-pss{font-size:16px;font-weight:800;color:var(--t-green)}

/* ═══ PAGE 3 VOUCHER ═══ */
.t-vbox{background:var(--t-white);border:1.5px solid var(--t-border);border-radius:var(--t-rlg);padding:20px;box-shadow:var(--t-sh)}
.t-vbl{font-size:13px;font-weight:700;margin-bottom:4px}
.t-vbs{font-size:12.5px;color:var(--t-text-2);margin-bottom:16px;line-height:1.6}
.t-virow{display:flex;gap:8px;margin-bottom:14px}
.t-vi{flex:1;background:var(--t-card);border:1.5px solid var(--t-border);border-radius:var(--t-r);padding:11px 14px;font-size:14px;font-weight:700;color:var(--t-text);font-family:inherit;letter-spacing:1.5px;text-transform:uppercase;outline:none;transition:border-color .2s}
.t-vi:focus{border-color:var(--t-accent)}
.t-vi::placeholder{color:var(--t-text-3);letter-spacing:0;font-weight:400;font-size:13px}
.t-btnap{padding:11px 20px;border-radius:var(--t-r);background:var(--t-accent);border:none;color:#fff;font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s;white-space:nowrap}
.t-btnap:hover{background:var(--t-accent-h);transform:translateY(-1px);box-shadow:var(--t-accent-glow)}
.t-vap{display:flex;align-items:center;gap:10px;background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:1.5px solid var(--t-green-mid);border-radius:var(--t-r);padding:12px 16px}
.t-vai{font-size:22px;flex-shrink:0}
.t-vain{flex:1}
.t-vann{font-size:13px;font-weight:700;color:var(--t-text)}
.t-vaam{font-size:12px;color:var(--t-green);font-weight:600;margin-top:1px}
.t-varm{background:none;border:none;color:var(--t-text-3);cursor:pointer;font-size:18px;transition:color .15s}
.t-varm:hover{color:var(--t-red)}
.t-avlbl{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1.5px;color:var(--t-text-3);margin:18px 0 10px}
.t-vlist{display:flex;flex-direction:column;gap:8px}
.t-vrow{display:flex;align-items:center;gap:12px;background:var(--t-card);border:1.5px solid var(--t-border);border-radius:var(--t-r);padding:12px 14px;cursor:pointer;transition:all .15s}
.t-vrow:hover{border-color:var(--t-accent-mid);background:var(--t-white)}
.t-vbdg{background:var(--t-accent-soft);border:1px solid var(--t-accent-mid);border-radius:6px;padding:5px 10px;font-size:11.5px;font-weight:800;color:var(--t-accent);letter-spacing:.5px;flex-shrink:0}
.t-vinfo{flex:1}
.t-vname{font-size:13px;font-weight:700;color:var(--t-text)}
.t-vexp{font-size:11px;color:var(--t-text-3);margin-top:2px}
.t-vdisc{font-size:14px;font-weight:800;color:var(--t-green)}

/* ═══ PAGE 4 PAYMENT ═══ */
.t-pmgrid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px}
.t-pmc{background:var(--t-white);border:2px solid var(--t-border);border-radius:var(--t-rlg);padding:18px 14px;text-align:center;cursor:pointer;transition:all .2s;user-select:none;box-shadow:var(--t-shsm)}
.t-pmc:hover{border-color:var(--t-border-dark);transform:translateY(-2px);box-shadow:var(--t-sh)}
.t-pmc.sel{border-color:var(--t-accent);background:var(--t-accent-soft);box-shadow:var(--t-sh),0 0 0 3px var(--t-accent-soft)}
.t-pmi{font-size:30px;margin-bottom:9px}
.t-pmn{font-size:13px;font-weight:800;color:var(--t-text)}
.t-pmd{font-size:11px;color:var(--t-text-2);margin-top:3px;line-height:1.4}
.t-pmc.sel .t-pmn{color:var(--t-accent)}
.t-pdet{display:none;background:var(--t-white);border:1.5px solid var(--t-border);border-radius:var(--t-rlg);padding:20px;box-shadow:var(--t-sh);animation:tFU .2s ease}
.t-pdet.show{display:block}
.t-pdttl{font-size:13.5px;font-weight:700;margin-bottom:16px;display:flex;align-items:center;gap:7px}
.t-pdttl i{color:var(--t-accent)}
.t-frow{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px}
.t-f{margin-bottom:10px}
.t-fl{font-size:11px;font-weight:700;color:var(--t-text-2);display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:.8px}
.t-fi{width:100%;background:var(--t-card);border:1.5px solid var(--t-border);border-radius:var(--t-r);padding:10px 13px;font-size:13.5px;color:var(--t-text);font-family:inherit;outline:none;transition:border-color .2s}
.t-fi:focus{border-color:var(--t-accent)}
.t-fi::placeholder{color:var(--t-text-3)}
.t-dgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:12px}
.t-dn{padding:10px;border-radius:var(--t-rsm);background:var(--t-card);border:1.5px solid var(--t-border);color:var(--t-text);font-size:12.5px;font-weight:700;cursor:pointer;text-align:center;transition:all .15s;font-family:inherit}
.t-dn:hover{border-color:var(--t-accent-mid);color:var(--t-accent);background:var(--t-accent-soft)}
.t-dn.full{grid-column:span 3}
.t-fiwrap{position:relative}
.t-fipre{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--t-text-2);font-weight:700;font-size:13px;pointer-events:none}
.t-fi.pl{padding-left:42px}
.t-chgrow{display:flex;align-items:center;justify-content:space-between;background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:1.5px solid var(--t-green-mid);border-radius:var(--t-r);padding:11px 16px;margin-top:10px}
.t-chgrow.hidden{display:none}
.t-crl{font-size:13px;color:var(--t-text-2)}
.t-crv{font-size:18px;font-weight:800;color:var(--t-green)}
.t-bib{background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1.5px solid var(--t-blue-mid);border-radius:var(--t-r);padding:14px 16px;margin-bottom:14px}
.t-bibr{display:flex;justify-content:space-between;font-size:12.5px;padding:3px 0}
.t-bibr .bk{font-weight:600;color:var(--t-text-2)}
.t-bibr .bv{font-weight:800;color:var(--t-text)}
.t-bibr .bvc{color:var(--t-blue);cursor:pointer;text-decoration:underline}
.t-hint{display:flex;align-items:flex-start;gap:8px;background:var(--t-accent-soft);border:1px solid var(--t-accent-mid);border-radius:var(--t-rsm);padding:10px 12px;font-size:12px;color:var(--t-text-2);line-height:1.6;margin-top:8px}
.t-hint i{color:var(--t-accent);font-size:15px;flex-shrink:0;margin-top:1px}

/* ═══ ORDER PANEL ═══ */
.t-op{background:var(--t-white);border-left:1px solid var(--t-border);display:flex;flex-direction:column;overflow:hidden}
.t-ophd{padding:14px 16px 10px;border-bottom:1px solid var(--t-border);flex-shrink:0;display:flex;align-items:center;justify-content:space-between}
.t-ophl{display:flex;align-items:center;gap:9px}
.t-opttl{font-family:'Instrument Serif',serif;font-size:17px;font-weight:400;color:var(--t-text)}
.t-opcnt{background:var(--t-accent-soft);color:var(--t-accent);border:1px solid var(--t-accent-mid);border-radius:10px;padding:2px 9px;font-size:11px;font-weight:700}
.t-btnclr{background:none;border:1.5px solid var(--t-border);border-radius:var(--t-rsm);color:var(--t-text-2);font-size:12px;font-weight:600;cursor:pointer;padding:4px 10px;font-family:inherit;transition:all .15s;display:flex;align-items:center;gap:4px}
.t-btnclr:hover{color:var(--t-red);border-color:rgba(220,38,38,.3);background:var(--t-red-soft)}
.t-oitems{flex:1;overflow-y:auto;padding:10px 16px}
.t-oempty{display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:8px;color:var(--t-text-3)}
.t-oempty .oei{font-size:40px;opacity:.22}
.t-oempty p{font-size:12.5px}
.t-oi{display:flex;align-items:center;gap:9px;padding:9px 11px;border-radius:var(--t-r);border:1px solid var(--t-border);margin-bottom:6px;background:var(--t-card);transition:all .15s;animation:tSI .18s ease}
@keyframes tSI{from{opacity:0;transform:translateX(8px)}to{opacity:1;transform:translateX(0)}}
.t-oi:hover{border-color:var(--t-border-dark);background:var(--t-white)}
.t-oiem{font-size:20px;flex-shrink:0}
.t-oib{flex:1;min-width:0}
.t-oin{font-size:12.5px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.t-oiu{font-size:11px;color:var(--t-text-3)}
.t-qctrl{display:flex;align-items:center;gap:5px;flex-shrink:0}
.t-qb{width:22px;height:22px;border-radius:5px;background:var(--t-white);border:1.5px solid var(--t-border);color:var(--t-text);cursor:pointer;font-size:13px;font-weight:800;display:flex;align-items:center;justify-content:center;transition:all .15s}
.t-qb:hover{border-color:var(--t-accent);color:var(--t-accent)}
.t-qn{font-size:13px;font-weight:800;min-width:20px;text-align:center}
.t-oitot{font-size:12.5px;font-weight:700;min-width:64px;text-align:right;flex-shrink:0}
.t-oidelb{background:none;border:none;color:var(--t-text-3);cursor:pointer;font-size:15px;transition:color .15s}
.t-oidelb:hover{color:var(--t-red)}
/* Bill */
.t-bill{padding:12px 16px;border-top:1px solid var(--t-border);flex-shrink:0;background:var(--t-card)}
.t-br{display:flex;justify-content:space-between;font-size:12.5px;color:var(--t-text-2);padding:3px 0}
.t-br .bv{font-weight:500}
.t-br.disc .bv{color:var(--t-green);font-weight:700}
.t-br.ptsd .bv{color:var(--t-gold);font-weight:700}
.t-bdiv{height:1px;background:var(--t-border);margin:8px 0}
.t-btotal{display:flex;justify-content:space-between;align-items:center;margin-top:2px}
.t-btl{font-size:14px;font-weight:800;color:var(--t-text)}
.t-btv{font-size:22px;font-weight:800;color:var(--t-accent)}
.t-earnst{display:flex;align-items:center;gap:8px;margin-top:9px;background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid var(--t-gold-mid);border-radius:var(--t-rsm);padding:8px 12px}
.t-esi{font-size:16px}
.t-est{font-size:12px;font-weight:600;color:var(--t-gold)}
.t-ess{font-size:11px;color:var(--t-text-2)}
/* Action area */
.t-actarea{padding:12px 16px 14px;flex-shrink:0;border-top:1px solid var(--t-border);display:flex;flex-direction:column;gap:8px}
.t-btnpro{width:100%;padding:14px;border-radius:var(--t-rlg);background:linear-gradient(135deg,var(--t-accent),#f97316);border:none;color:#fff;font-size:14.5px;font-weight:800;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .2s}
.t-btnpro:hover{transform:translateY(-2px);box-shadow:var(--t-accent-glow)}
.t-btnpro:active{transform:translateY(0)}
.t-btnpro:disabled{opacity:.35;cursor:not-allowed;transform:none;box-shadow:none}
.t-btnpro i{font-size:18px}
.t-btnbk{width:100%;padding:10px;border-radius:var(--t-r);background:none;border:1.5px solid var(--t-border);color:var(--t-text-2);font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:6px}
.t-btnbk:hover{background:var(--t-card);border-color:var(--t-border-dark);color:var(--t-text)}

/* ═══ PAGE 5 RECEIPT ═══ */
.t-rcpg{padding:24px;display:flex;flex-direction:column;align-items:center;height:100%;overflow-y:auto}
.t-rcico{font-size:56px;margin-bottom:14px;animation:tBI .5s cubic-bezier(.34,1.56,.64,1) .1s both}
@keyframes tBI{from{transform:scale(0)}to{transform:scale(1)}}
.t-rctit{font-family:'Instrument Serif',serif;font-size:26px;margin-bottom:4px;text-align:center}
.t-rcsub{font-size:13px;color:var(--t-text-2);margin-bottom:24px;text-align:center}
.t-pcbox{width:100%;background:linear-gradient(135deg,#fffbeb,#fef3c7);border:2px solid var(--t-gold-mid);border-radius:var(--t-rlg);padding:16px 20px;margin-bottom:16px;display:flex;align-items:center;gap:14px}
.t-pcico{font-size:32px}
.t-pcpts{font-size:22px;font-weight:800;color:var(--t-gold)}
.t-pcnm{font-size:12px;font-weight:600;color:var(--t-text);margin-top:2px}
.t-pcbl{font-size:11.5px;color:var(--t-text-2)}
.t-rcbox{width:100%;background:var(--t-white);border:1px solid var(--t-border);border-radius:var(--t-rlg);padding:16px 20px;margin-bottom:20px;box-shadow:var(--t-sh)}
.t-rr{display:flex;justify-content:space-between;font-size:12.5px;color:var(--t-text-2);padding:3px 0}
.t-rr .rv{font-weight:500}
.t-rr.tot{font-size:14px;font-weight:800;color:var(--t-text);padding-top:9px;margin-top:6px;border-top:1px solid var(--t-border)}
.t-rr.tot .rv{color:var(--t-accent);font-size:16px}
.t-rcacts{display:grid;grid-template-columns:1fr 1fr;gap:9px;width:100%}
.t-ra{padding:12px;border-radius:var(--t-r);font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:6px}
.t-ra.out{background:none;border:2px solid var(--t-border);color:var(--t-text-2)}
.t-ra.out:hover{background:var(--t-card);border-color:var(--t-border-dark);color:var(--t-text)}
.t-ra.sol{background:linear-gradient(135deg,var(--t-accent),#f97316);border:none;color:#fff}
.t-ra.sol:hover{transform:translateY(-1px);box-shadow:var(--t-accent-glow)}

/* ═══ MODAL / OVERLAY ═══ */
.t-overlay{position:fixed;inset:0;background:rgba(28,24,20,.45);z-index:9999;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.t-overlay.show{display:flex}
.t-modal{background:var(--t-white);border-radius:var(--t-rxl);padding:24px;box-shadow:var(--t-shlg);animation:tPop .25s cubic-bezier(.34,1.56,.64,1);width:420px;max-width:95vw}
.t-mhd{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
.t-mttl{font-family:'Instrument Serif',serif;font-size:19px}
.t-mclose{background:var(--t-card);border:1.5px solid var(--t-border);border-radius:var(--t-rsm);width:28px;height:28px;display:flex;align-items:center;justify-content:center;color:var(--t-text-2);cursor:pointer;font-size:17px;transition:all .15s}
.t-mclose:hover{color:var(--t-red);border-color:rgba(220,38,38,.3)}
.t-rf{margin-bottom:12px}
.t-rf label{font-size:11px;font-weight:700;color:var(--t-text-2);display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:.8px}
.t-rf input,.t-rf select{width:100%;background:var(--t-card);border:1.5px solid var(--t-border);border-radius:var(--t-r);padding:10px 13px;font-size:13.5px;color:var(--t-text);font-family:inherit;outline:none;transition:border-color .2s}
.t-rf input:focus{border-color:var(--t-green)}
.t-rf input::placeholder{color:var(--t-text-3)}
.t-hintbox{display:flex;align-items:flex-start;gap:7px;background:var(--t-blue-soft);border:1px solid var(--t-blue-mid);border-radius:var(--t-rsm);padding:10px 12px;font-size:12px;color:var(--t-text-2);line-height:1.6;margin-bottom:14px}
.t-hintbox i{color:var(--t-blue);flex-shrink:0;margin-top:1px}
.t-btnreg{width:100%;padding:12px;border-radius:var(--t-r);background:linear-gradient(135deg,var(--t-green),#059669);border:none;color:#fff;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .18s}
.t-btnreg:hover{transform:translateY(-1px);box-shadow:0 4px 18px rgba(22,163,74,.3)}

/* ═══ TOAST ═══ */
.t-toast{position:fixed;bottom:22px;left:50%;transform:translateX(-50%) translateY(70px);background:var(--t-text);color:#fff;border-radius:10px;padding:10px 18px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;z-index:99999;transition:transform .3s cubic-bezier(.34,1.56,.64,1);box-shadow:var(--t-shlg);white-space:nowrap}
.t-toast.show{transform:translateX(-50%) translateY(0)}
.t-toast i{color:var(--t-gold);font-size:15px}
</style>
@endsection

@section('content')
<div class="terminal-root">

  {{-- ══ STEP BAR ══ --}}
  <div class="t-stepbar" id="stepBar">
    <div class="t-si active" data-step="1" onclick="goStep(1)">
      <div class="t-snum">1</div><span class="t-slbl">Menu</span>
    </div>
    <div class="t-scon"></div>
    <div class="t-si" data-step="2" onclick="jumpStep(2)">
      <div class="t-snum">2</div><span class="t-slbl">Loyalty Points</span>
    </div>
    <div class="t-scon"></div>
    <div class="t-si" data-step="3" onclick="jumpStep(3)">
      <div class="t-snum">3</div><span class="t-slbl">Voucher</span>
    </div>
    <div class="t-scon"></div>
    <div class="t-si" data-step="4" onclick="jumpStep(4)">
      <div class="t-snum">4</div><span class="t-slbl">Payment</span>
    </div>
    <div class="t-scon"></div>
    <div class="t-si" data-step="5">
      <div class="t-snum">5</div><span class="t-slbl">Done</span>
    </div>
  </div>

  {{-- ══ MAIN AREA ══ --}}
  <div class="t-main">

    {{-- PAGE 1: MENU --}}
    <div class="t-page active" id="pg1">
      <div class="t-ph">
        <div class="t-ptitle">Select Items</div>
        <div class="t-psub">Tap any item to add it to the order. Use categories to filter.</div>
      </div>
      <div class="t-pb">
        <div class="t-srow">
          <div class="t-sbox">
            <i class="ri-search-line"></i>
            <input id="menuSearch" type="text" placeholder="Search items by name…" oninput="filterMenu(this.value)"/>
          </div>
        </div>
        <div class="t-catrow" id="catPills">
          <button class="t-cpill on" onclick="filterCat('all',this)">All Items</button>
          <button class="t-cpill" onclick="filterCat('chicken',this)">🍗 Chicken</button>
          <button class="t-cpill" onclick="filterCat('meals',this)">🥡 Meals</button>
          <button class="t-cpill" onclick="filterCat('sides',this)">🍟 Sides</button>
          <button class="t-cpill" onclick="filterCat('drinks',this)">🥤 Drinks</button>
          <button class="t-cpill" onclick="filterCat('desserts',this)">🍦 Desserts</button>
        </div>
        <div id="menuContent"></div>
      </div>
    </div>

    {{-- PAGE 2: LOYALTY --}}
    <div class="t-page" id="pg2">
      <div class="t-ph">
        <div class="t-ptitle">Loyalty Points</div>
        <div class="t-psub">Look up the customer's VFM card to check their points and apply a redemption.</div>
      </div>
      <div class="t-pb">
        <div id="loyLookupArea">
          <div class="t-lrow">
            <input class="t-linp" id="loyInput" type="text" placeholder="Enter phone number, card no., or name…" onkeydown="if(event.key==='Enter')lookupCust()"/>
            <button class="t-btnfind" onclick="lookupCust()"><i class="ri-search-line"></i> Find Customer</button>
            <button class="t-btnskip" onclick="goStep(3)"><i class="ri-arrow-right-line"></i> Skip</button>
          </div>
          <div style="text-align:center;padding:28px 0;color:var(--t-text-3);font-size:12.5px">
            No customer linked ·
            <span style="color:var(--t-accent);cursor:pointer;font-weight:600" onclick="openModal('regModal')">+ Register new customer</span>
          </div>
        </div>
        <div id="loyFoundArea" style="display:none">
          <div class="t-cc">
            <div class="t-cc-hd">
              <div class="t-cc-av" id="ccAv">SK</div>
              <div class="t-cc-info">
                <div class="t-cc-name" id="ccName">Sara Khan</div>
                <div class="t-cc-meta">
                  <span id="ccPhone">0300-1234567</span>
                  <span class="t-tier" id="ccTier">Gold</span>
                  <span style="font-size:11px;color:var(--t-text-3)" id="ccCard">VFM-2024-8821</span>
                </div>
              </div>
              <button class="t-cc-unlink" onclick="unlinkCust()"><i class="ri-close-circle-line"></i></button>
            </div>
            <div class="t-cc-pts">
              <div class="t-cc-pt"><div class="t-cc-pl">Total Pts</div><div class="t-cc-pv gold" id="ccPtsTotal">12,450</div></div>
              <div class="t-cc-pt"><div class="t-cc-pl">Usable Today</div><div class="t-cc-pv" id="ccPtsUsable">5,000</div></div>
              <div class="t-cc-pt"><div class="t-cc-pl">Value (Rs.)</div><div class="t-cc-pv" style="color:var(--t-green)" id="ccPtsVal">500</div></div>
            </div>
          </div>
          <div class="t-ptsc">
            <div class="t-ptsc-ttl">Would you like to use loyalty points?</div>
            <div class="t-ptsc-sub">Customer has <strong id="pcPtsAmt" style="color:var(--t-gold)">12,450 pts</strong> available. Using points gives a direct discount on this order.</div>
            <div class="t-optrow">
              <div class="t-opt" id="optYes" onclick="choosePts(true)">
                <div class="t-oi-c">🪙</div>
                <div class="t-oi-t">Yes, use points</div>
                <div class="t-oi-s" id="optYesSub">Up to 5,000 pts</div>
              </div>
              <div class="t-opt" id="optNo" onclick="choosePts(false)">
                <div class="t-oi-c">➡️</div>
                <div class="t-oi-t">No, skip for now</div>
                <div class="t-oi-s">Earn points on this purchase</div>
              </div>
            </div>
            <div class="t-slsec" id="sliderSection">
              <div class="t-slhd">
                <span class="sl">How many points to use?</span>
                <span class="sv" id="sliderLabel">0 pts = Rs. 0 off</span>
              </div>
              <input type="range" class="t-range" id="ptsSlider" min="0" max="5000" step="50" value="0" oninput="onSlider(this.value)" style="--pct:0%"/>
              <div class="t-rlbls">
                <span>0 pts</span>
                <span id="sliderCurrent" style="color:var(--t-gold);font-weight:700">0 selected</span>
                <span id="sliderMax">5,000 pts</span>
              </div>
              <div class="t-psum">
                <div><div class="t-psl">Points to use</div><div class="t-psv" id="psrPts">0 pts</div></div>
                <div class="t-psdiv"></div>
                <div style="text-align:right"><div class="t-psl">Your savings</div><div class="t-pss" id="psrSave">Rs. 0</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- PAGE 3: VOUCHER --}}
    <div class="t-page" id="pg3">
      <div class="t-ph">
        <div class="t-ptitle">Apply Voucher</div>
        <div class="t-psub">Enter a voucher code or choose from available promotions. You can skip this step.</div>
      </div>
      <div class="t-pb">
        <div class="t-vbox">
          <div class="t-vbl">Enter Voucher Code</div>
          <div class="t-vbs">Type the code printed on the physical voucher, shared via SMS, or sent by email.</div>
          <div class="t-virow">
            <input class="t-vi" id="voucherCode" type="text" placeholder="e.g. KFCVFM20" oninput="this.value=this.value.toUpperCase()"/>
            <button class="t-btnap" onclick="applyVoucher()">Apply</button>
          </div>
          <div id="voucherApplied" style="display:none">
            <div class="t-vap">
              <span class="t-vai">🎉</span>
              <div class="t-vain">
                <div class="t-vann" id="voucherName">20% OFF — VFM Welcome</div>
                <div class="t-vaam" id="voucherSaving">Saving: Rs.0</div>
              </div>
              <button class="t-varm" onclick="removeVoucher()"><i class="ri-close-circle-line"></i></button>
            </div>
          </div>
        </div>
        <div class="t-avlbl">Available Promotions</div>
        <div class="t-vlist">
          <div class="t-vrow" onclick="quickVoucher('KFCVFM20')">
            <div class="t-vbdg">KFCVFM20</div>
            <div class="t-vinfo"><div class="t-vname">VFM Welcome Offer</div><div class="t-vexp">Valid till 31 Mar 2026 · New members</div></div>
            <div class="t-vdisc">20% OFF</div>
          </div>
          <div class="t-vrow" onclick="quickVoucher('FLAT200')">
            <div class="t-vbdg">FLAT200</div>
            <div class="t-vinfo"><div class="t-vname">Rs.200 Flat Discount</div><div class="t-vexp">Valid till 15 Apr 2026 · Any order</div></div>
            <div class="t-vdisc">−Rs.200</div>
          </div>
          <div class="t-vrow" onclick="quickVoucher('EID30')">
            <div class="t-vbdg">EID30</div>
            <div class="t-vinfo"><div class="t-vname">Eid Celebration Special</div><div class="t-vexp">Valid till 04 Apr 2026 · Limited stock</div></div>
            <div class="t-vdisc">30% OFF</div>
          </div>
          <div class="t-vrow" onclick="quickVoucher('RAMADAN15')">
            <div class="t-vbdg">RAMADAN15</div>
            <div class="t-vinfo"><div class="t-vname">Ramadan Iftar Deal</div><div class="t-vexp">Valid till 30 Mar 2026 · All orders</div></div>
            <div class="t-vdisc">15% OFF</div>
          </div>
        </div>
      </div>
    </div>

    {{-- PAGE 4: PAYMENT --}}
    <div class="t-page" id="pg4">
      <div class="t-ph">
        <div class="t-ptitle">Choose Payment Method</div>
        <div class="t-psub">Select how the customer wants to pay. All amounts are in PKR.</div>
      </div>
      <div class="t-pb">
        <div class="t-pmgrid">
          <div class="t-pmc sel" id="pm-cash" onclick="selPay('cash')">
            <div class="t-pmi">💵</div><div class="t-pmn">Cash</div>
            <div class="t-pmd">Physical notes &amp; coins handed at counter</div>
          </div>
          <div class="t-pmc" id="pm-card" onclick="selPay('card')">
            <div class="t-pmi">💳</div><div class="t-pmn">Debit / Credit Card</div>
            <div class="t-pmd">Visa, Mastercard, UnionPay via POS machine</div>
          </div>
          <div class="t-pmc" id="pm-jazz" onclick="selPay('jazz')">
            <div class="t-pmi">📲</div><div class="t-pmn">JazzCash / EasyPaisa</div>
            <div class="t-pmd">Mobile wallet transfer or QR scan</div>
          </div>
          <div class="t-pmc" id="pm-bank" onclick="selPay('bank')">
            <div class="t-pmi">🏦</div><div class="t-pmn">Bank Transfer</div>
            <div class="t-pmd">Online transfer to merchant account</div>
          </div>
        </div>

        {{-- Cash --}}
        <div class="t-pdet show" id="pd-cash">
          <div class="t-pdttl"><i class="ri-money-rupee-circle-line"></i>Cash Payment</div>
          <div class="t-dgrid">
            <button class="t-dn" onclick="setDenom(100)">100</button>
            <button class="t-dn" onclick="setDenom(500)">500</button>
            <button class="t-dn" onclick="setDenom(1000)">1,000</button>
            <button class="t-dn" onclick="setDenom(2000)">2,000</button>
            <button class="t-dn" onclick="setDenom(5000)">5,000</button>
            <button class="t-dn" onclick="setDenom(10000)">10,000</button>
            <button class="t-dn full" onclick="setExact()">⚡ Set Exact Amount</button>
          </div>
          <div class="t-fiwrap">
            <span class="t-fipre">Rs.</span>
            <input class="t-fi pl" id="cashAmt" type="number" placeholder="Amount received" oninput="calcChange()"/>
          </div>
          <div class="t-chgrow hidden" id="changeRow">
            <span class="t-crl">Change to return</span>
            <span class="t-crv" id="changeVal">Rs.0</span>
          </div>
        </div>

        {{-- Card --}}
        <div class="t-pdet" id="pd-card">
          <div class="t-pdttl"><i class="ri-bank-card-line"></i>Card Payment via POS Machine</div>
          <div class="t-frow">
            <div class="t-f"><label class="t-fl">Card Type</label>
              <select class="t-fi"><option>Visa (Debit / Credit)</option><option>Mastercard</option><option>UnionPay</option><option>Amex</option></select>
            </div>
            <div class="t-f"><label class="t-fl">Transaction Ref. No.</label>
              <input class="t-fi" type="text" placeholder="e.g. TRX-002841"/>
            </div>
          </div>
          <div class="t-hint"><i class="ri-information-line"></i>Insert or tap the customer's card on the POS machine. Enter the approval / reference code shown after successful processing.</div>
        </div>

        {{-- JazzCash --}}
        <div class="t-pdet" id="pd-jazz">
          <div class="t-pdttl"><i class="ri-smartphone-line"></i>JazzCash / EasyPaisa Transfer</div>
          <div class="t-bib">
            <div class="t-bibr"><span class="bk">Merchant Name</span><span class="bv">KFC Saddar (VFM)</span></div>
            <div class="t-bibr"><span class="bk">JazzCash No.</span><span class="bv bvc" onclick="showToast('0312-1234567 copied')">0312-1234567</span></div>
            <div class="t-bibr"><span class="bk">EasyPaisa No.</span><span class="bv bvc" onclick="showToast('0314-9876543 copied')">0314-9876543</span></div>
            <div class="t-bibr"><span class="bk">Amount Due</span><span class="bv" id="jazzDue">Rs.0</span></div>
          </div>
          <div class="t-f"><label class="t-fl">Transaction ID from Customer's App</label>
            <input class="t-fi" type="text" placeholder="e.g. TXN-20260310-18291"/>
          </div>
          <div class="t-hint"><i class="ri-information-line"></i>Ask the customer to send the exact amount to the number above, then enter the Transaction ID from their confirmation SMS.</div>
        </div>

        {{-- Bank --}}
        <div class="t-pdet" id="pd-bank">
          <div class="t-pdttl"><i class="ri-building-2-line"></i>Bank Transfer (IBFT / Raast)</div>
          <div class="t-bib">
            <div class="t-bibr"><span class="bk">Account Title</span><span class="bv">VFM Foods Pvt Ltd</span></div>
            <div class="t-bibr"><span class="bk">Bank Name</span><span class="bv">Meezan Bank</span></div>
            <div class="t-bibr"><span class="bk">Account No.</span><span class="bv bvc" onclick="showToast('Account No. copied')">0129-0104601234</span></div>
            <div class="t-bibr"><span class="bk">IBAN</span><span class="bv bvc" onclick="showToast('IBAN copied')">PK36MEZN0001290104601234</span></div>
            <div class="t-bibr"><span class="bk">Amount Due</span><span class="bv" id="bankDue">Rs.0</span></div>
          </div>
          <div class="t-frow">
            <div class="t-f"><label class="t-fl">Sender's Bank</label><input class="t-fi" placeholder="e.g. HBL, UBL"/></div>
            <div class="t-f"><label class="t-fl">Transaction Ref. No.</label><input class="t-fi" placeholder="From confirmation SMS"/></div>
          </div>
          <div class="t-hint"><i class="ri-information-line"></i>Customer transfers via IBFT or Raast. Ask them to share the transaction confirmation SMS.</div>
        </div>
      </div>
    </div>

    {{-- PAGE 5: DONE --}}
    <div class="t-page" id="pg5">
      <div class="t-rcpg">
        <div class="t-rcico">✅</div>
        <div class="t-rctit">Payment Complete!</div>
        <div class="t-rcsub" id="rcSub">Order processed successfully</div>
        <div class="t-pcbox" id="rcPtsBox" style="display:none">
          <div class="t-pcico">🪙</div>
          <div>
            <div class="t-pcpts" id="rcPtsNum">+0 pts</div>
            <div class="t-pcnm" id="rcPtsName">Points credited to VFM Card</div>
            <div class="t-pcbl" id="rcPtsBal">New balance: 0 pts</div>
          </div>
        </div>
        <div class="t-rcbox" id="rcBox"></div>
        <div class="t-rcacts">
          <button class="t-ra out" onclick="showToast('Sending to printer…')"><i class="ri-printer-line"></i> Print Receipt</button>
          <button class="t-ra sol" onclick="newOrder()"><i class="ri-add-circle-line"></i> New Order</button>
        </div>
      </div>
    </div>

  </div>{{-- end t-main --}}

  {{-- ══ ORDER PANEL ══ --}}
  <div class="t-op">
    <div class="t-ophd">
      <div class="t-ophl">
        <span class="t-opttl">Current Order</span>
        <span class="t-opcnt" id="opCount">0 items</span>
      </div>
      <button class="t-btnclr" onclick="clearOrder()"><i class="ri-delete-bin-line"></i> Clear</button>
    </div>
    <div class="t-oitems" id="orderItems">
      <div class="t-oempty" id="orderEmpty">
        <div class="oei">🛒</div>
        <p>No items yet · tap menu to add</p>
      </div>
    </div>
    <div class="t-bill" id="billSection" style="display:none">
      <div class="t-br"><span>Subtotal</span><span class="bv" id="bSub">Rs.0</span></div>
      <div class="t-br disc" id="bDiscRow" style="display:none"><span>Voucher Discount</span><span class="bv" id="bDisc">-Rs.0</span></div>
      <div class="t-br ptsd" id="bPtsRow" style="display:none"><span>Points Redeemed</span><span class="bv" id="bPts">-Rs.0</span></div>
      <div class="t-br"><span>Tax (16%)</span><span class="bv" id="bTax">Rs.0</span></div>
      <div class="t-bdiv"></div>
      <div class="t-btotal">
        <span class="t-btl">Total</span>
        <span class="t-btv" id="bTotal">Rs.0</span>
      </div>
      <div class="t-earnst" id="ptsEarnStrip" style="display:none">
        <span class="t-esi">🪙</span>
        <div><div class="t-est" id="pesNum">+0 pts will be earned</div><div class="t-ess">Points credited after payment</div></div>
      </div>
    </div>
    <div class="t-actarea" id="actionArea">
      <button class="t-btnpro" id="proceedBtn" onclick="proceed()" disabled>
        <i class="ri-add-circle-line"></i> Add items to continue
      </button>
    </div>
  </div>

</div>{{-- end terminal-root --}}

{{-- ══ REGISTER MODAL ══ --}}
<div class="t-overlay" id="regModal">
  <div class="t-modal">
    <div class="t-mhd">
      <span class="t-mttl">Register New Customer</span>
      <button class="t-mclose" onclick="closeModal('regModal')"><i class="ri-close-line"></i></button>
    </div>
    <div class="t-rf"><label>Full Name *</label><input id="rn" placeholder="Customer full name"/></div>
    <div class="t-rf"><label>Phone Number *</label><input id="rp" type="tel" placeholder="03XXXXXXXXX"/></div>
    <div class="t-rf"><label>Email (Optional)</label><input id="re" type="email" placeholder="email@example.com"/></div>
    <div class="t-rf"><label>Date of Birth (Optional)</label><input type="date" style="color-scheme:light"/></div>
    <div class="t-hintbox"><i class="ri-information-line"></i>A VFM loyalty card number is auto-generated. Login credentials and card number are sent instantly via SMS and Email to the customer.</div>
    <button class="t-btnreg" onclick="doRegister()"><i class="ri-user-add-line"></i> Register &amp; Create VFM Card</button>
  </div>
</div>

{{-- TOAST --}}
<div class="t-toast" id="toast"><i class="ri-check-circle-fill"></i><span id="toastMsg">Done</span></div>
@endsection

@section('page-wise-scripts')
<script>
// ══ DATA ══
const MENU=[
  {n:'Zinger Burger',e:'🍔',p:520,c:'chicken'},
  {n:'Zinger Stacker',e:'🍔',p:720,c:'chicken'},
  {n:'Crispy Strips 3pc',e:'🍗',p:480,c:'chicken'},
  {n:'Hot & Crispy 2pc',e:'🍗',p:420,c:'chicken'},
  {n:'Chicken Fillet',e:'🍗',p:380,c:'chicken'},
  {n:'Zinger Meal',e:'🥡',p:850,c:'meals'},
  {n:'Family Bucket',e:'🪣',p:2500,c:'meals'},
  {n:'Mighty Meal',e:'🥡',p:1100,c:'meals'},
  {n:'Twister Meal',e:'🥡',p:950,c:'meals'},
  {n:'French Fries Reg',e:'🍟',p:220,c:'sides'},
  {n:'French Fries Lrg',e:'🍟',p:280,c:'sides'},
  {n:'Coleslaw',e:'🥗',p:150,c:'sides'},
  {n:'Corn Cob',e:'🌽',p:180,c:'sides'},
  {n:'Garlic Bread',e:'🧄',p:160,c:'sides'},
  {n:'Pepsi Regular',e:'🥤',p:120,c:'drinks'},
  {n:'Pepsi Large',e:'🥤',p:180,c:'drinks'},
  {n:'Mineral Water',e:'💧',p:80,c:'drinks'},
  {n:'Frooti',e:'🧃',p:100,c:'drinks'},
  {n:'Shake Vanilla',e:'🥛',p:240,c:'drinks'},
  {n:'Soft Serve',e:'🍦',p:120,c:'desserts'},
  {n:'Choc Mousse',e:'🍫',p:200,c:'desserts'},
  {n:'Brownie',e:'🍩',p:180,c:'desserts'},
];
const CATS={chicken:'🍗 Chicken',meals:'🥡 Meals',sides:'🍟 Sides',drinks:'🥤 Drinks',desserts:'🍦 Desserts'};
const VOUCHERS={
  'KFCVFM20':{label:'20% OFF — VFM Welcome',type:'pct',val:.2},
  'FLAT200'  :{label:'Rs.200 Flat Discount', type:'flat',val:200},
  'EID30'    :{label:'30% OFF — Eid Special', type:'pct',val:.3},
  'RAMADAN15':{label:'15% Ramadan Special',  type:'pct',val:.15},
};

// ══ STATE ══
let order=[],custLinked=false,custData=null;
let voucherDsc=0,voucherLabel='';
let ptsDsc=0,ptsUsed=0;
let curStep=1,activePay='cash';
let orderSeq=Math.floor(Math.random()*9000)+1000;

// ══ MENU ══
function renderMenu(items){
  let html='',lastCat='';
  items.forEach(it=>{
    if(it.c!==lastCat){
      if(lastCat)html+='</div>';
      html+=`<div class="t-cslbl">${CATS[it.c]||it.c}</div><div class="t-mgrid">`;
      lastCat=it.c;
    }
    const inO=order.find(o=>o.n===it.n);
    html+=`<div class="t-mi" onclick="addItem('${it.n}','${it.e}',${it.p})">
      <div class="t-mi-shine"></div>
      ${inO?`<div class="t-mi-badge">${inO.qty}</div>`:''}
      <div class="t-mi-em">${it.e}</div>
      <div class="t-mi-name">${it.n}</div>
      <div class="t-mi-foot">
        <span class="t-mi-price">Rs.${it.p.toLocaleString()}</span>
        <button class="t-mi-add" onclick="event.stopPropagation();addItem('${it.n}','${it.e}',${it.p})"><i class="ri-add-line"></i></button>
      </div>
    </div>`;
  });
  if(items.length&&lastCat)html+='</div>';
  else if(!items.length)html='<div style="text-align:center;padding:48px;color:var(--t-text-3)">No items found 🔍</div>';
  document.getElementById('menuContent').innerHTML=html;
}
renderMenu(MENU);
function filterCat(cat,btn){
  document.querySelectorAll('.t-cpill').forEach(b=>b.classList.remove('on'));
  btn.classList.add('on');
  document.getElementById('menuSearch').value='';
  renderMenu(cat==='all'?MENU:MENU.filter(i=>i.c===cat));
}
function filterMenu(q){renderMenu(q?MENU.filter(i=>i.n.toLowerCase().includes(q.toLowerCase())):MENU);}

// ══ ORDER ══
function addItem(n,e,p){
  const ex=order.find(i=>i.n===n);
  if(ex)ex.qty++;else order.push({n,e,p,qty:1});
  renderOrder();renderMenu(MENU);showToast(`${e} ${n} added`);
}
function chQty(i,d){order[i].qty+=d;if(order[i].qty<=0)order.splice(i,1);renderOrder();renderMenu(MENU);}
function delItem(i){const nm=order[i].n;order.splice(i,1);renderOrder();renderMenu(MENU);showToast('Removed: '+nm);}
function clearOrder(){if(!order.length)return;order=[];voucherDsc=0;voucherLabel='';ptsDsc=0;ptsUsed=0;renderOrder();renderMenu(MENU);showToast('Order cleared');}

function renderOrder(){
  const list=document.getElementById('orderItems');
  const empty=document.getElementById('orderEmpty');
  const bill=document.getElementById('billSection');
  const btn=document.getElementById('proceedBtn');
  document.getElementById('opCount').textContent=order.length+' item'+(order.length!==1?'s':'');
  if(!order.length){
    list.innerHTML='';list.appendChild(empty);empty.style.display='flex';
    bill.style.display='none';btn.disabled=true;
    btn.innerHTML='<i class="ri-add-circle-line"></i> Add items to continue';
    return;
  }
  empty.style.display='none';bill.style.display='block';btn.disabled=false;
  list.innerHTML=order.map((it,i)=>`
    <div class="t-oi">
      <span class="t-oiem">${it.e}</span>
      <div class="t-oib"><div class="t-oin">${it.n}</div><div class="t-oiu">Rs.${it.p.toLocaleString()} each</div></div>
      <div class="t-qctrl">
        <button class="t-qb" onclick="chQty(${i},-1)">−</button>
        <span class="t-qn">${it.qty}</span>
        <button class="t-qb" onclick="chQty(${i},1)">+</button>
      </div>
      <span class="t-oitot">Rs.${(it.p*it.qty).toLocaleString()}</span>
      <button class="t-oidelb" onclick="delItem(${i})"><i class="ri-delete-bin-line"></i></button>
    </div>`).join('');
  calcBill();
}

// ══ BILL ══
function calcBill(){
  const sub=order.reduce((s,i)=>s+i.p*i.qty,0);
  const tax=Math.round(sub*.16);
  const total=Math.max(0,sub-voucherDsc-ptsDsc+tax);
  const pts=custLinked?Math.floor(sub/10)*2:0;
  document.getElementById('bSub').textContent='Rs.'+sub.toLocaleString();
  document.getElementById('bTax').textContent='Rs.'+tax.toLocaleString();
  document.getElementById('bTotal').textContent='Rs.'+total.toLocaleString();
  document.getElementById('bDiscRow').style.display=voucherDsc?'flex':'none';
  document.getElementById('bDisc').textContent='-Rs.'+voucherDsc.toLocaleString();
  document.getElementById('bPtsRow').style.display=ptsDsc?'flex':'none';
  document.getElementById('bPts').textContent='-Rs.'+ptsDsc.toLocaleString();
  const pes=document.getElementById('ptsEarnStrip');
  pes.style.display=custLinked&&sub?'flex':'none';
  document.getElementById('pesNum').textContent='+'+pts+' pts will be earned';
  const ts='Rs.'+total.toLocaleString();
  ['jazzDue','bankDue'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=ts;});
  return{sub,tax,total,pts};
}

// ══ STEPS ══
function goStep(n){
  if(n>1&&!order.length){showToast('Add items before proceeding');return;}
  curStep=n;
  for(let i=1;i<=5;i++){const pg=document.getElementById('pg'+i);if(pg)pg.classList.toggle('active',i===n);}
  document.querySelectorAll('.t-si').forEach(el=>{
    const s=parseInt(el.dataset.step);
    el.classList.toggle('active',s===n);
    el.classList.toggle('done',s<n);
  });
  updateProceedBtn();
}
function jumpStep(n){if(n<=curStep)goStep(n);}
function proceed(){
  if(curStep===1){if(!order.length){showToast('Add at least one item');return;}goStep(2);}
  else if(curStep===2)goStep(3);
  else if(curStep===3)goStep(4);
  else if(curStep===4)doCheckout();
}
function updateProceedBtn(){
  const btn=document.getElementById('proceedBtn');
  const area=document.getElementById('actionArea');
  if(!order.length){btn.disabled=true;btn.innerHTML='<i class="ri-add-circle-line"></i> Add items to continue';return;}
  btn.disabled=false;
  const labels={
    1:'<i class="ri-arrow-right-circle-fill"></i> Continue to Loyalty Points',
    2:'<i class="ri-arrow-right-circle-fill"></i> Continue to Voucher',
    3:'<i class="ri-arrow-right-circle-fill"></i> Continue to Payment',
    4:'<i class="ri-check-double-line"></i> Process Payment'
  };
  btn.innerHTML=labels[curStep]||'Continue';
  btn.style.display=curStep===5?'none':'flex';
  const existing=area.querySelector('.t-btnbk');
  if(existing)existing.remove();
  if(curStep>1&&curStep<5){
    const bk=document.createElement('button');
    bk.className='t-btnbk';bk.innerHTML='<i class="ri-arrow-left-line"></i> Back';
    bk.onclick=()=>goStep(curStep-1);
    area.appendChild(bk);
  }
}

// ══ CUSTOMER ══
function lookupCust(){
  const v=document.getElementById('loyInput').value.trim();
  if(!v||v.length<3){showToast('Enter at least 3 characters');return;}
  linkCust({name:'Sara Khan',phone:'0300-1234567',card:'VFM-2024-8821',pts:12450,usable:5000,tier:'Gold',av:'SK'});
}
function linkCust(d){
  custLinked=true;custData=d;
  document.getElementById('loyLookupArea').style.display='none';
  document.getElementById('loyFoundArea').style.display='block';
  document.getElementById('ccAv').textContent=d.av;
  document.getElementById('ccName').textContent=d.name;
  document.getElementById('ccPhone').textContent=d.phone;
  document.getElementById('ccTier').textContent=d.tier;
  document.getElementById('ccCard').textContent=d.card;
  document.getElementById('ccPtsTotal').textContent=d.pts.toLocaleString();
  document.getElementById('ccPtsUsable').textContent=d.usable.toLocaleString();
  document.getElementById('ccPtsVal').textContent=Math.floor(d.usable/10).toLocaleString();
  document.getElementById('pcPtsAmt').textContent=d.pts.toLocaleString()+' pts';
  document.getElementById('optYesSub').textContent='Up to '+d.usable.toLocaleString()+' pts';
  document.getElementById('sliderMax').textContent=d.usable.toLocaleString()+' pts';
  document.getElementById('ptsSlider').max=d.usable;
  calcBill();showToast('✓ Customer linked: '+d.name);
}
function unlinkCust(){
  custLinked=false;custData=null;ptsDsc=0;ptsUsed=0;
  document.getElementById('loyFoundArea').style.display='none';
  document.getElementById('loyLookupArea').style.display='block';
  document.getElementById('loyInput').value='';
  document.getElementById('ptsSlider').value=0;onSlider(0);
  document.getElementById('sliderSection').classList.remove('show');
  document.getElementById('optYes').className='t-opt';
  document.getElementById('optNo').className='t-opt';
  calcBill();showToast('Customer unlinked');
}
function choosePts(yes){
  document.getElementById('optYes').className='t-opt'+(yes?' syes':'');
  document.getElementById('optNo').className='t-opt'+(!yes?' sno':'');
  document.getElementById('sliderSection').classList.toggle('show',yes);
  if(!yes){ptsDsc=0;ptsUsed=0;document.getElementById('ptsSlider').value=0;onSlider(0);calcBill();}
}
function onSlider(v){
  const pts=parseInt(v)||0;const disc=Math.floor(pts/10);
  ptsDsc=disc;ptsUsed=pts;
  const max=custData?custData.usable:5000;
  const pct=(pts/max*100).toFixed(1);
  document.getElementById('ptsSlider').style.setProperty('--pct',pct+'%');
  document.getElementById('sliderLabel').textContent=pts.toLocaleString()+' pts = Rs.'+disc.toLocaleString()+' off';
  document.getElementById('sliderCurrent').textContent=pts.toLocaleString()+' pts';
  document.getElementById('psrPts').textContent=pts.toLocaleString()+' pts';
  document.getElementById('psrSave').textContent='Rs. '+disc.toLocaleString();
  calcBill();
}

// ══ VOUCHER ══
function applyVoucher(){applyCode(document.getElementById('voucherCode').value.trim().toUpperCase());}
function quickVoucher(code){document.getElementById('voucherCode').value=code;applyCode(code);}
function applyCode(code){
  const sub=order.reduce((s,i)=>s+i.p*i.qty,0);
  if(!sub){showToast('Add items to order first');return;}
  if(!code){showToast('Enter a voucher code');return;}
  if(!VOUCHERS[code]){showToast('Invalid voucher code');return;}
  const v=VOUCHERS[code];
  voucherDsc=v.type==='pct'?Math.floor(sub*v.val):Math.min(v.val,sub);
  voucherLabel=v.label;
  document.getElementById('voucherApplied').style.display='block';
  document.getElementById('voucherName').textContent=v.label;
  document.getElementById('voucherSaving').textContent='Saving: Rs.'+voucherDsc.toLocaleString();
  calcBill();showToast('✓ Voucher applied: '+v.label);
}
function removeVoucher(){
  voucherDsc=0;voucherLabel='';
  document.getElementById('voucherApplied').style.display='none';
  document.getElementById('voucherCode').value='';
  calcBill();showToast('Voucher removed');
}

// ══ PAYMENT ══
function selPay(type){
  document.querySelectorAll('.t-pmc').forEach(c=>c.classList.remove('sel'));
  document.getElementById('pm-'+type).classList.add('sel');
  activePay=type;
  ['cash','card','jazz','bank'].forEach(t=>{
    const d=document.getElementById('pd-'+t);
    if(d)d.classList.toggle('show',t===type);
  });
}
function setDenom(v){document.getElementById('cashAmt').value=v;calcChange();}
function setExact(){const{total}=calcBill();document.getElementById('cashAmt').value=total;calcChange();}
function calcChange(){
  const got=parseInt(document.getElementById('cashAmt').value)||0;
  const{total}=calcBill();
  const row=document.getElementById('changeRow');
  if(got>=total&&total>0){row.classList.remove('hidden');document.getElementById('changeVal').textContent='Rs.'+(got-total).toLocaleString();}
  else row.classList.add('hidden');
}

// ══ CHECKOUT ══
function doCheckout(){
  if(!order.length){showToast('No items in order');return;}
  if(activePay==='cash'){
    const got=parseInt(document.getElementById('cashAmt').value)||0;
    const{total}=calcBill();
    if(got<total){showToast('Cash received is less than the total');return;}
  }
  const{sub,tax,total,pts}=calcBill();
  document.getElementById('rcSub').textContent=order.length+' item(s) · Order #'+(++orderSeq);
  if(pts>0&&custLinked&&custData){
    document.getElementById('rcPtsBox').style.display='flex';
    document.getElementById('rcPtsNum').textContent='+'+pts+' pts';
    document.getElementById('rcPtsName').textContent='Credited to '+custData.name+"'s VFM Card";
    document.getElementById('rcPtsBal').textContent='New balance: '+(custData.pts-ptsUsed+pts).toLocaleString()+' pts';
  }else document.getElementById('rcPtsBox').style.display='none';
  let rcHtml=order.map(it=>`<div class="t-rr"><span>${it.e} ${it.n} ×${it.qty}</span><span class="rv">Rs.${(it.p*it.qty).toLocaleString()}</span></div>`).join('');
  rcHtml+=`<div class="t-rr"><span>Subtotal</span><span class="rv">Rs.${sub.toLocaleString()}</span></div>`;
  if(voucherDsc)rcHtml+=`<div class="t-rr"><span>Voucher</span><span class="rv" style="color:var(--t-green)">-Rs.${voucherDsc.toLocaleString()}</span></div>`;
  if(ptsDsc)rcHtml+=`<div class="t-rr"><span>Points Redeemed</span><span class="rv" style="color:var(--t-gold)">-Rs.${ptsDsc.toLocaleString()}</span></div>`;
  rcHtml+=`<div class="t-rr"><span>Tax (16%)</span><span class="rv">Rs.${tax.toLocaleString()}</span></div>`;
  rcHtml+=`<div class="t-rr tot"><span>Total Paid</span><span class="rv">Rs.${total.toLocaleString()}</span></div>`;
  const payLabels={cash:'Cash',card:'Card (POS)',jazz:'JazzCash / EasyPaisa',bank:'Bank Transfer'};
  rcHtml+=`<div class="t-rr" style="margin-top:6px;padding-top:6px;border-top:1px solid var(--t-border)"><span>Payment via</span><span class="rv">${payLabels[activePay]}</span></div>`;
  if(activePay==='cash'){
    const got=parseInt(document.getElementById('cashAmt').value)||0;
    rcHtml+=`<div class="t-rr"><span>Cash Received</span><span class="rv">Rs.${got.toLocaleString()}</span></div>`;
    rcHtml+=`<div class="t-rr"><span>Change</span><span class="rv" style="color:var(--t-green)">Rs.${(got-total).toLocaleString()}</span></div>`;
  }
  document.getElementById('rcBox').innerHTML=rcHtml;
  goStep(5);
}
function newOrder(){
  order=[];voucherDsc=0;voucherLabel='';ptsDsc=0;ptsUsed=0;custLinked=false;custData=null;
  document.getElementById('cashAmt').value='';
  document.getElementById('voucherCode').value='';
  document.getElementById('voucherApplied').style.display='none';
  document.getElementById('loyFoundArea').style.display='none';
  document.getElementById('loyLookupArea').style.display='block';
  document.getElementById('loyInput').value='';
  document.getElementById('ptsSlider').value=0;onSlider(0);
  document.getElementById('sliderSection').classList.remove('show');
  document.getElementById('optYes').className='t-opt';
  document.getElementById('optNo').className='t-opt';
  document.getElementById('changeRow').classList.add('hidden');
  renderOrder();renderMenu(MENU);goStep(1);
}

// ══ MODAL ══
function openModal(id){document.getElementById(id).classList.add('show');}
function closeModal(id){document.getElementById(id).classList.remove('show');}
function doRegister(){
  const name=document.getElementById('rn').value.trim();
  const phone=document.getElementById('rp').value.trim();
  if(!name){showToast('Enter customer name');return;}
  if(!phone||phone.length<10){showToast('Enter valid phone number');return;}
  closeModal('regModal');
  const av=name.split(' ').map(w=>w[0]).join('').slice(0,2).toUpperCase();
  linkCust({name,phone,card:'VFM-NEW-'+Math.floor(Math.random()*9000+1000),pts:500,usable:500,tier:'Silver',av});
  showToast('✓ Registered! 500 welcome points credited. SMS sent.');
}

// ══ TOAST ══
function showToast(msg){
  const t=document.getElementById('toast');
  document.getElementById('toastMsg').textContent=msg;
  t.classList.add('show');clearTimeout(t._t);
  t._t=setTimeout(()=>t.classList.remove('show'),2800);
}

// ══ INIT ══
renderOrder();updateProceedBtn();
</script>
@endsection
 --}}




















{{-- @include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Cashier Terminal'])
    @include('partials.head-css')
    <style>
        .payment-method-btn { cursor:pointer; transition: all .2s; border:2px solid transparent; }
        .payment-method-btn:hover { border-color: var(--vz-primary); }
        .payment-method-btn.selected { border-color: var(--vz-primary); background-color: rgba(var(--vz-primary-rgb), .08); }
        .bill-divider { border-top: 2px dashed #dee2e6; }
        .qr-placeholder { background: repeating-linear-gradient(45deg,#f8f9fa,#f8f9fa 2px,#fff 2px,#fff 10px); }
        .tier-bar { height: 8px; border-radius: 4px; background: #e9ecef; }
    </style>
</head>
<body>
@include('partials.body-attr')
<div id="layout-wrapper">
    @include('layouts.navbarheader')
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- Terminal Header -->
                <div class="row"><div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0"><i class="ri-shopping-cart-line me-2 text-primary"></i>Cashier Terminal</h4>
                            <small class="text-muted">KFC – Downtown · Counter 2 · <span class="text-success fw-medium"><i class="ri-record-circle-fill"></i> Live</span> · Cashier: <strong>Sofia Reyes</strong></small>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="badge bg-success-subtle text-success fs-12 px-3 py-2">Shift: 09:00 – 17:00</span>
                            <a href="{{ route('cashier.shift') }}" class="btn btn-soft-secondary btn-sm"><i class="ri-time-line me-1"></i>Shift Summary</a>
                        </div>
                    </div>
                </div></div>

                <div class="row g-3">

                    <!-- LEFT PANEL: Card Lookup + Customer -->
                    <div class="col-xl-4">

                        <!-- Card Lookup -->
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0"><i class="ri-credit-card-line me-2 text-primary"></i>Card Lookup</h5></div>
                            <div class="card-body">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="ri-qr-code-line"></i></span>
                                    <input type="text" class="form-control font-monospace" id="cardInput" placeholder="VFM-XXXX or scan..." value="VFM-4482">
                                    <button class="btn btn-primary" onclick="loadCustomer()">Load</button>
                                </div>
                                <div class="d-flex flex-wrap gap-1 mb-2">
                                    @foreach(['VFM-4482','VFM-7731','VFM-1190','VFM-8843'] as $cn)
                                    <span onclick="quickLoad('{{ $cn }}')" class="badge bg-primary-subtle text-primary cursor-pointer" style="cursor:pointer;">{{ $cn }}</span>
                                    @endforeach
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-soft-secondary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#qrScanModal"><i class="ri-qr-code-line me-1"></i>QR Scan</button>
                                    <button class="btn btn-soft-success btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#newCustomerModal"><i class="ri-user-add-line me-1"></i>New Customer</button>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Profile Card -->
                        <div class="card" id="customerCard">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-warning-subtle text-warning fs-20 fw-bold">MC</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2">
                                            <h5 class="mb-0">Maria Chen</h5>
                                            <span class="badge bg-warning-subtle text-warning">Gold</span>
                                        </div>
                                        <div class="font-monospace text-primary small">VFM-4482</div>
                                        <small class="text-muted">maria@email.com · +1 917-555-0101</small>
                                    </div>
                                    <div class="text-end">
                                        <h3 class="mb-0 text-primary fw-bold">1,840</h3>
                                        <small class="text-muted">Points</small>
                                    </div>
                                </div>
                                <!-- Tier Progress -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="text-muted">Gold → Platinum</small>
                                        <small class="text-muted">1,840 / 5,000 pts</small>
                                    </div>
                                    <div class="tier-bar"><div class="progress-bar bg-warning rounded" style="height:8px;width:37%;"></div></div>
                                </div>
                                <!-- Quick Stats -->
                                <div class="row g-2 text-center">
                                    <div class="col-4"><div class="bg-light rounded p-2"><div class="fw-bold text-success small">$142.70</div><div class="text-muted" style="font-size:10px;">Total Spent</div></div></div>
                                    <div class="col-4"><div class="bg-light rounded p-2"><div class="fw-bold text-warning small">3,200</div><div class="text-muted" style="font-size:10px;">Lifetime Pts</div></div></div>
                                    <div class="col-4"><div class="bg-light rounded p-2"><div class="fw-bold text-info small">12</div><div class="text-muted" style="font-size:10px;">Visits</div></div></div>
                                </div>
                            </div>
                        </div>

                        <!-- Available Coupons -->
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0"><i class="ri-coupon-line me-2 text-warning"></i>Available Coupons</h5></div>
                            <div class="card-body p-0">
                                @foreach([['SAVE20','20% off any order','percent','Min. $15'],['FREE50','+50 bonus points','bonus','Any order']] as $c)
                                <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                    <div>
                                        <span class="font-monospace fw-bold text-warning">{{ $c[0] }}</span>
                                        <div class="text-muted small">{{ $c[1] }} · {{ $c[3] }}</div>
                                    </div>
                                    <button onclick="applyCoupon('{{ $c[0] }}')" class="btn btn-soft-warning btn-sm">Apply</button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- MIDDLE PANEL: Billing -->
                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0"><i class="ri-receipt-line me-2 text-success"></i>Bill & Checkout</h5>
                                <span id="invoiceNo" class="badge bg-secondary-subtle text-secondary font-monospace">INV-0001</span>
                            </div>
                            <div class="card-body">
                                <!-- Bill Amount -->
                                <div class="mb-3">
                                    <label class="form-label">Bill Amount <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text fw-bold">$</span>
                                        <input type="number" class="form-control fw-bold fs-20" id="billAmount" placeholder="0.00" step="0.01" min="0" oninput="recalculate()">
                                    </div>
                                </div>

                                <!-- Items Description -->
                                <div class="mb-3">
                                    <label class="form-label">Items / Description</label>
                                    <input type="text" class="form-control" id="itemDesc" placeholder="e.g. Zinger Combo + Pepsi">
                                </div>

                                <!-- Point Rule -->
                                <div class="mb-3">
                                    <label class="form-label">Point Rule</label>
                                    <select class="form-select" id="pointRule" onchange="recalculate()">
                                        <option value="10">Standard Spend ($1 = 10 pts)</option>
                                        <option value="15">Weekend Bonus ($1 = 15 pts)</option>
                                        <option value="20">Happy Hour ($1 = 20 pts)</option>
                                    </select>
                                </div>

                                <!-- Coupon -->
                                <div class="mb-3">
                                    <label class="form-label">Coupon Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control font-monospace" id="couponInput" placeholder="Enter or apply from left">
                                        <button class="btn btn-soft-warning" onclick="applyCoupon(document.getElementById('couponInput').value)">Apply</button>
                                        <button class="btn btn-soft-danger" onclick="removeCoupon()"><i class="ri-close-line"></i></button>
                                    </div>
                                    <div id="couponStatus" class="d-none mt-1">
                                        <span class="badge bg-success-subtle text-success"><i class="ri-checkbox-circle-line me-1"></i>SAVE20 applied — 20% off</span>
                                    </div>
                                </div>

                                <!-- Redeem Points -->
                                <div class="mb-3">
                                    <label class="form-label d-flex justify-content-between">
                                        <span>Redeem Points as Discount</span>
                                        <small class="text-muted">Balance: 1,840 pts = $18.40 max</small>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="redeemPts" placeholder="0" min="0" max="1840" oninput="recalculate()">
                                        <span class="input-group-text">pts</span>
                                    </div>
                                    <div class="form-text">100 pts = $1.00 discount</div>
                                </div>

                                <hr class="bill-divider">

                                <!-- Bill Summary -->
                                <div id="billSummary">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Subtotal</span><span id="subtotalVal" class="fw-medium">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Coupon Discount</span><span id="couponVal" class="text-success fw-medium">-$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Points Discount</span><span id="ptsDiscVal" class="text-warning fw-medium">-$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1 fw-bold fs-16 border-top pt-2 mt-2">
                                        <span>Total Payable</span><span id="totalVal" class="text-primary">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted small">Points to Earn</span>
                                        <span id="ptsEarnVal" class="badge bg-success-subtle text-success">+0 pts</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT PANEL: Payment Method + Confirm -->
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0"><i class="ri-bank-card-line me-2 text-info"></i>Payment Method</h5></div>
                            <div class="card-body">
                                <!-- Payment Methods -->
                                <div class="row g-2 mb-3">
                                    @php
                                    $pmethods = [
                                        ['cash','ri-money-dollar-circle-line','Cash','success'],
                                        ['card','ri-bank-card-2-line','Card','primary'],
                                        ['qr','ri-qr-code-line','QR / Scan','warning'],
                                        ['wallet','ri-wallet-3-line','Digital Wallet','info'],
                                        ['split','ri-split-cells-vertical','Split','secondary'],
                                        ['credit','ri-time-line','Store Credit','danger'],
                                    ];
                                    @endphp
                                    @foreach($pmethods as $pm)
                                    <div class="col-4">
                                        <div class="card border payment-method-btn text-center p-2 mb-0 {{ $pm[0]==='cash'?'selected':'' }}" onclick="selectPayment(this,'{{ $pm[0] }}')" data-method="{{ $pm[0] }}">
                                            <i class="{{ $pm[1] }} fs-22 text-{{ $pm[3] }}"></i>
                                            <div class="fw-medium" style="font-size:11px;">{{ $pm[2] }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Cash Payment -->
                                <div id="cash-panel">
                                    <div class="mb-2">
                                        <label class="form-label">Cash Tendered</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="cashTendered" placeholder="0.00" oninput="calcChange()">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between p-2 bg-light rounded mb-2">
                                        <span class="text-muted">Change</span>
                                        <span id="changeVal" class="fw-bold text-success">$0.00</span>
                                    </div>
                                    <!-- Quick Cash Buttons -->
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach([5,10,20,50,100] as $denom)
                                        <button onclick="setCash({{ $denom }})" class="btn btn-soft-secondary btn-sm">${{ $denom }}</button>
                                        @endforeach
                                        <button onclick="exactCash()" class="btn btn-soft-success btn-sm">Exact</button>
                                    </div>
                                </div>

                                <!-- Card Payment -->
                                <div id="card-panel" class="d-none">
                                    <div class="alert alert-primary py-2 mb-2">
                                        <i class="ri-information-line me-2"></i>
                                        <small>Swipe or insert customer's bank/credit card on POS terminal.</small>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Card Type</label>
                                        <select class="form-select">
                                            <option>Visa</option><option>Mastercard</option><option>Amex</option><option>Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Last 4 Digits (optional)</label>
                                        <input type="text" class="form-control font-monospace" placeholder="XXXX" maxlength="4">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Approval / Auth Code</label>
                                        <input type="text" class="form-control font-monospace" placeholder="e.g. AUTH-8842">
                                    </div>
                                </div>

                                <!-- QR Payment -->
                                <div id="qr-panel" class="d-none text-center">
                                    <p class="text-muted small mb-2">Customer scans to pay via JazzCash, EasyPaisa, SadaPay etc.</p>
                                    <div class="qr-placeholder border rounded mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:140px;height:140px;">
                                        <i class="ri-qr-code-line fs-48 text-muted"></i>
                                    </div>
                                    <p class="text-muted small">QR refreshes on amount change</p>
                                    <select class="form-select form-select-sm mb-2">
                                        <option>Any QR App</option><option>JazzCash</option><option>EasyPaisa</option><option>SadaPay</option><option>Raast</option>
                                    </select>
                                </div>

                                <!-- Digital Wallet -->
                                <div id="wallet-panel" class="d-none">
                                    <div class="mb-2">
                                        <label class="form-label">Wallet Provider</label>
                                        <select class="form-select">
                                            <option>JazzCash</option><option>EasyPaisa</option><option>SadaPay</option><option>NayaPay</option><option>Apple Pay</option><option>Google Pay</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Transaction Reference</label>
                                        <input type="text" class="form-control font-monospace" placeholder="e.g. JC-88234">
                                    </div>
                                    <div class="alert alert-info py-2 mb-0"><i class="ri-information-line me-1"></i><small>Confirm payment on wallet app before proceeding.</small></div>
                                </div>

                                <!-- Split Payment -->
                                <div id="split-panel" class="d-none">
                                    <p class="text-muted small mb-2">Split total amount across multiple payment methods</p>
                                    <div class="mb-2">
                                        <label class="form-label">Cash Portion ($)</label>
                                        <input type="number" class="form-control" placeholder="0.00">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Card Portion ($)</label>
                                        <input type="number" class="form-control" placeholder="0.00">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Wallet Portion ($)</label>
                                        <input type="number" class="form-control" placeholder="0.00">
                                    </div>
                                    <div class="d-flex justify-content-between p-2 bg-light rounded">
                                        <span class="text-muted">Remaining</span><span class="fw-bold text-danger" id="splitRemaining">$0.00</span>
                                    </div>
                                </div>

                                <!-- Store Credit -->
                                <div id="credit-panel" class="d-none">
                                    <div class="alert alert-warning py-2 mb-2">
                                        <i class="ri-alert-line me-1"></i><small>Requires manager approval for store credit transactions.</small>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Manager PIN</label>
                                        <input type="password" class="form-control" placeholder="••••">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Reason</label>
                                        <input type="text" class="form-control" placeholder="e.g. VIP customer, complaint resolution">
                                    </div>
                                </div>

                                <hr>

                                <!-- Notes -->
                                <div class="mb-3">
                                    <label class="form-label">Transaction Notes (optional)</label>
                                    <textarea class="form-control" rows="2" placeholder="e.g. Birthday celebration, special request..."></textarea>
                                </div>

                                <!-- Process Button -->
                                <button class="btn btn-success w-100 btn-lg fw-bold" onclick="processPayment()">
                                    <i class="ri-checkbox-circle-line me-2"></i>Process Payment & Add Points
                                </button>
                                <button class="btn btn-soft-danger w-100 mt-2 btn-sm" onclick="voidTransaction()">
                                    <i class="ri-delete-bin-line me-1"></i>Void / Cancel Transaction
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Transactions -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0"><i class="ri-history-line me-2 text-info"></i>Today's Transactions (Counter 2)</h5>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-success-subtle text-success">23 completed</span>
                                    <a href="{{ route('cashier.void-refund') }}" class="btn btn-soft-danger btn-sm"><i class="ri-delete-bin-line me-1"></i>Void/Refund</a>
                                    <a href="{{ route('cashier.transactions') }}" class="btn btn-soft-primary btn-sm">View All</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr><th>Time</th><th>Invoice</th><th>Card</th><th>Items</th><th>Amount</th><th>Payment</th><th>Points</th><th>Coupon</th><th>Status</th></tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $txns = [
                                                ['09:42','INV-0023','VFM-4482','Zinger Combo','$18.50','Cash','success','+185','—','Completed','success'],
                                                ['09:15','INV-0022','VFM-1190','Family Bucket','$47.00','Card','primary','+564','SAVE20','Completed','success'],
                                                ['08:55','INV-0021','VFM-7731','Twister Wrap','$14.20','QR','warning','+142','—','Completed','success'],
                                                ['08:30','INV-0020','VFM-3356','Mega Meal','$38.00','Wallet','info','+304','—','Completed','success'],
                                                ['08:10','INV-0019','VFM-8843','Snack Box','$10.50','Cash','success','+105','—','Voided','danger'],
                                            ];
                                            @endphp
                                            @foreach($txns as $t)
                                            <tr>
                                                <td><small class="text-muted">{{ $t[0] }}</small></td>
                                                <td><span class="font-monospace text-muted small">{{ $t[1] }}</span></td>
                                                <td><span class="font-monospace text-primary">{{ $t[2] }}</span></td>
                                                <td><small>{{ $t[3] }}</small></td>
                                                <td class="fw-semibold">{{ $t[4] }}</td>
                                                <td><span class="badge bg-{{ $t[6] }}-subtle text-{{ $t[6] }}"><i class="{{ $t[5]==='Cash'?'ri-money-dollar-circle-line':($t[5]==='Card'?'ri-bank-card-line':($t[5]==='QR'?'ri-qr-code-line':'ri-wallet-3-line')) }} me-1"></i>{{ $t[5] }}</span></td>
                                                <td><span class="badge bg-success-subtle text-success">{{ $t[7] }}</span></td>
                                                <td>@if($t[8]!=='—')<span class="badge bg-warning-subtle text-warning">{{ $t[8] }}</span>@else<span class="text-muted">—</span>@endif</td>
                                                <td><span class="badge bg-{{ $t[10] }}-subtle text-{{ $t[10] }}">{{ $t[9] }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

<!-- QR Scan Modal -->
<div class="modal fade" id="qrScanModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-qr-code-line me-2"></i>Scan VFM Card QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="qr-placeholder border rounded mx-auto d-flex align-items-center justify-content-center mb-3" style="width:200px;height:200px;">
                    <i class="ri-camera-line fs-48 text-muted"></i>
                </div>
                <p class="text-muted small">Point camera at customer's VFM QR code</p>
                <div class="alert alert-success d-none" id="qrResult"><i class="ri-checkbox-circle-line me-2"></i>VFM-4482 scanned!</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary w-100" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>

<!-- New Customer Modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-user-add-line me-2 text-success"></i>Register New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6"><label class="form-label">First Name</label><input type="text" class="form-control" placeholder="e.g. Ali"></div>
                    <div class="col-6"><label class="form-label">Last Name</label><input type="text" class="form-control" placeholder="e.g. Raza"></div>
                    <div class="col-12"><label class="form-label">Phone Number <span class="text-danger">*</span></label><input type="tel" class="form-control" placeholder="+92 300 0000000"></div>
                    <div class="col-12"><label class="form-label">Email (optional)</label><input type="email" class="form-control" placeholder="email@example.com"></div>
                    <div class="col-12"><label class="form-label">Assign VFM Card</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control font-monospace" placeholder="Auto-assign or enter card no." value="VFM-9128">
                            <button class="btn btn-soft-secondary btn-sm"><i class="ri-shuffle-line"></i></button>
                        </div>
                    </div>
                    <div class="col-12"><label class="form-label">City</label><input type="text" class="form-control" placeholder="e.g. Lahore"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"><i class="ri-user-add-line me-1"></i>Register & Load Card</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast" class="toast text-bg-success" role="alert">
        <div class="toast-body d-flex align-items-center gap-2">
            <i class="ri-checkbox-circle-line fs-18"></i>
            <span id="toastMsg">Transaction processed successfully!</span>
        </div>
    </div>
</div>

@include('layouts.customizer')
@include('partials.scripts')
<script>
var couponApplied = false;
function loadCustomer(){var v=document.getElementById('cardInput').value; document.getElementById('customerCard').classList.remove('d-none');}
function quickLoad(cn){document.getElementById('cardInput').value=cn; loadCustomer();}
function applyCoupon(code){if(code){couponApplied=true; document.getElementById('couponInput').value=code; document.getElementById('couponStatus').classList.remove('d-none'); recalculate();}}
function removeCoupon(){couponApplied=false; document.getElementById('couponInput').value=''; document.getElementById('couponStatus').classList.add('d-none'); recalculate();}
function recalculate(){
    var bill=parseFloat(document.getElementById('billAmount').value)||0;
    var rate=parseInt(document.getElementById('pointRule').value)||10;
    var couponDisc=couponApplied?bill*0.2:0;
    var redeemPts=parseInt(document.getElementById('redeemPts').value)||0;
    var ptsDisc=redeemPts/100;
    var total=Math.max(0,bill-couponDisc-ptsDisc);
    var ptsEarn=Math.floor(total*rate);
    document.getElementById('subtotalVal').textContent='$'+bill.toFixed(2);
    document.getElementById('couponVal').textContent='-$'+couponDisc.toFixed(2);
    document.getElementById('ptsDiscVal').textContent='-$'+ptsDisc.toFixed(2);
    document.getElementById('totalVal').textContent='$'+total.toFixed(2);
    document.getElementById('ptsEarnVal').textContent='+'+ptsEarn+' pts';
}
function calcChange(){
    var total=parseFloat(document.getElementById('totalVal').textContent.replace('$',''))||0;
    var tendered=parseFloat(document.getElementById('cashTendered').value)||0;
    document.getElementById('changeVal').textContent='$'+Math.max(0,tendered-total).toFixed(2);
}
function setCash(v){document.getElementById('cashTendered').value=v; calcChange();}
function exactCash(){var t=parseFloat(document.getElementById('totalVal').textContent.replace('$',''))||0; document.getElementById('cashTendered').value=t.toFixed(2); calcChange();}
function selectPayment(el,method){
    document.querySelectorAll('.payment-method-btn').forEach(b=>b.classList.remove('selected'));
    el.classList.add('selected');
    ['cash','card','qr','wallet','split','credit'].forEach(p=>document.getElementById(p+'-panel').classList.add('d-none'));
    document.getElementById(method+'-panel').classList.remove('d-none');
}
function processPayment(){
    var t=new bootstrap.Toast(document.getElementById('successToast'));
    document.getElementById('toastMsg').textContent='Transaction processed! +185 pts added to VFM-4482';
    t.show();
    document.getElementById('billAmount').value='';
    document.getElementById('itemDesc').value='';
    recalculate();
}
function voidTransaction(){if(confirm('Are you sure you want to void this transaction?')){alert('Transaction voided.');}}
</script>
</body>
</html> --}}