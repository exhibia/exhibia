var debugging = false;
var debuggingLevel = 3;
var pageID = 0;
var loggedIn = false;
var accountUsername = "";
var isDev = false;
var ignoreOf = false;
var ignoreOfTimeout = 0;
var hasWatchedAuctions = false;
var isGeoEnabled = false;
var showedHighCOGSWarning = false;
var removeWatchedDiv = false;
var sson = true;
var ssonly = false;
var bidoActive = false;
var realBidsValue = 0;
var realBids = 0;
var freeBids = 0;
var reloadTimeout;
var reloadPauseTimeout;
var lastUpdateProcess = new Date().getTime();
var buyitnowTime = 0;
var timerBuyItNowID;

function Class_Auctions() {
    var s = 0;
    var e = 0;
    var M = 0;
    var aw = 0;
    var n = 0;
    var l = 0;
    var R = 0;
    var t = 0;
    var ai = 0;
    var C = false;
    var Z = new Array();
    var U;
    var b = 0;
    var E;
    var f = (new Date()).getTime();
    var G = 0;
    var q = 0;
    var au = 1;
    var m = new Array();
    var y = 0;
    var H = 0;
    var p = 0;
    var P = 0;
    var Q = false;
    var d = true;
    var at = 0;
    var a = 0;
    var aq = 0;
    var h = 0;
    var F = 0;
    var J = 0;
    var Y = null;
    var ac = "";
    var I = 0;
    var V = 0;
    var k = 0;
    var W = false;
    var g = null;
    var an = new Array();
    var ax = 0;
    var al = 0;
    var ab = 0;
    var ap;
    var ao;
    var aa = new Array();
    var B = new Array();
    var u = new Array();
    var w = function (aA, az, ay) {
            if (!at) {
                at = j()
            }
            this.id = aA;
            this.grabid = r(aA);
            this.state = (!az ? "Active" : az);
            this.timeleft = -1;
            this.timeleft2 = -1;
            this.bidder = "No Bids Yet!";
            this.price = 0;
            this.version = 0;
            this.avatar = "";
            this.spotlocation = ay;
            this.lastupdate = 0;
            this.lastprice = -1;
            this.laststate = "";
            this.lastbidder = "";
            this.lasttimeupdate = -1;
            this.lasttime = 0;
            this.bidon = -1;
            this.slocation = false
        };
    this.initializeInterval = function () {
        try {
            if (B.length > 0) {
                if (y) {
                    Auctions.simulationInterval();
                    timerAuction = $.timer(au * 1000, Auctions.simulationInterval)
                } else {
                    Auctions.ajaxInterval();
                    if (pageID == 2 && loggedIn) {
                        timerAuction = $.timer(au * 1000, Auctions.ajaxInterval)
                    } else {
                        timerAuction = $.timer(au * 1000, Auctions.ajaxInterval)
                    }
                }
                setTimeout("Auctions.initializeDisplayInterval()", 150)
            }
            if (pageID == 1 && loggedIn == false) {
                ssonly = true
            }
        } catch (ay) {
            showConsole(ay, "JS Error")
        }
    };
    this.initializeDisplayInterval = function () {
        timerDisplay = $.timer(au * 500, Auctions.displayInterval)
    };
    this.setupDetailed = function (aF, aD, az, ay, aC, aB, aA, aE) {
        s = aF;
        e = aD;
        M = az;
        aw = ay;
        n = aC;
        l = aB;
        h = aE;
        F = aA
    };
    this.registerAuctionSpot = function (aD, aA, az) {
        try {
            if (!aA) {
                aA = "regular"
            }
            showConsole("Registering Spot: " + aD + " (" + aA + ")", null, 2);
            aD = parseInt(aD);
            if (aD < 1) {
                return
            }
            var aC = ae();
            var ay;
            if (aC["a" + aD] == undefined) {
                ay = B.length;
                if (!az) {
                    az = "Active"
                }
                B[ay] = new w(aD, az, aA)
            } else {
                ay = aC["a" + aD]
            }
            if (aA == "endingspot" || aA == "beginnerspot" || aA == "topspot" || aA == "comingsoon") {
                B[ay].slocation = true
            }
            if (!u[aA]) {
                u[aA] = new Array()
            }
            u[aA].push(aD);
            am();
            R = 0;
            return ay
        } catch (aB) {
            showConsole(aB, "JS Error")
        }
    };
    this.resetBIN = function () {
        R = 0;
        t = 0;
        ai = 0
    };
    this.registerSimulationSpot = function (aE, aB, aA, ay) {
        try {
            if (!aB) {
                aB = "regular"
            }
            showConsole("Registering Spot: " + aE + " (" + aB + ")", null, 2);
            aE = parseInt(aE);
            if (aE < 1) {
                return
            }
            var aD = ae();
            var az;
            if (aD["a" + aE] == undefined) {
                az = B.length;
                B[az] = new w(aE, "Active", aB)
            } else {
                az = aD["a" + aE]
            }
            if (aA) {
                B[az].price = aA;
                B[az].bidder = o()
            }
            if (ay) {
                B[az].timeleft = ay
            }
            y = true;
            if (aB == "endingspot" || aB == "beginnerspot" || aB == "topspot" || aB == "comingsoon") {
                B[az].slocation = true
            }
            if (!u[aB]) {
                u[aB] = new Array()
            }
            u[aB].push(aE);
            am()
        } catch (aC) {
            showConsole(aC, "JS Error")
        }
    };
    this.registerAuctions = function (az, ay) {
        try {
            if (!az) {
                return
            }
            if (!ay) {
                ay = "General"
            }
            if (az.constructor.toString().indexOf("Array") == -1) {
                Auctions.registerAuctionSpot(az, ay)
            } else {
                $.each(az, function (aB, aC) {
                    Auctions.registerAuctionSpot(aC, ay)
                })
            }
            am()
        } catch (aA) {
            showConsole(aA, "JS Error")
        }
    };
    this.unregisterAuction = function (aA) {
        try {
            showConsole("Unregistering: " + aA, null, 2);
            var ay = null;
            $.each(B, function (aC) {
                var aB = B[aC];
                if (aB.id == aA) {
                    ay = aC
                }
            });
            B.splice(ay, 1);
            am()
        } catch (az) {
            showConsole(az, "JS Error")
        }
    };
    this.unregisterAuctionSpots = function (ay) {
        try {
            if (ay == null) {
                return
            }
            showConsole("Unregistering Category: " + ay, null, 2);
            if (!u[ay]) {
                u[ay] = new Array()
            }
            showConsole(u[ay], "Pre-Removal Category", 2);
            AuctionData2 = new Array();
            jQuery.each(B, function (aA, aB) {
                if (jQuery.inArray(aB.id, u[ay]) && aB.id != s) {} else {
                    AuctionData2[AuctionData2.length] = aB
                }
            });
            B = AuctionData2;
            u[ay] = new Array();
            am()
        } catch (az) {
            showConsole(az, "JS Error")
        }
    };
    this.killAuctions = function () {
        try {
            B = new Array();
            Q = true;
            if (timerAuction) {
                timerAuction.stop()
            }
            if (timerDisplay) {
                timerDisplay.stop()
            }
            timerAuction = null;
            timerDisplay = null
        } catch (ay) {
            showConsole(ay, "JS Error")
        }
    };
    this.loadCompletedDetails = function (aB) {
        var aA = (new Date()).getTime();
        if (!at) {
            at = j()
        }
        aB = parseInt(aB);
        var ay = r(aB);
        var az = "/ajax/eoa.php?id=" + ay + "&cs=" + cValue(ay).substring(0, 20) + "&a=34";
        $.ajax({
            url: az,
            cache: false,
            dataType: "json",
            timeout: 2500,
            success: function (aD) {
                if (!aD) {
                    return
                }
                for (id in aD) {
                    try {
                        if (id == "price") {
                            H = parseFloat(aD[id]);
                            $("#price_" + s).html(aD[id] + ' <span class="last-price-currency">' + cCode + "</span>");
                            continue
                        } else {
                            if (id == "v") {
                                p = aD[id];
                                continue
                            } else {
                                if (id == "savings") {
                                    $("#savingsamt").html("Savings: " + aD[id] + "%");
                                    continue
                                } else {
                                    if (id == "winnerInfo") {
                                        var aC = parseInt(aD[id].Real);
                                        var aF = parseInt(aD[id].Voucher);
                                        if (aC == 0 && aF == 0) {
                                            aC = "N/A";
                                            winner_placedBidsValue = "N/A";
                                            aF = "N/A"
                                        }
                                        $("#winnerInfo_RealBids").html("Real Bids (" + aC + "):");
                                        $("#winnerInfo_RealValue").html("-" + aD[id].RealValue + "");
                                        $("#winnerInfo_VoucherBids").html("Voucher Bids (" + aF + "):");
                                        $("#winnerInfo_VoucherValue").html("-" + aD[id].VoucherValue + "");
                                        $("#winnerInfo_FinalPrice").html("-" + $("#price_" + s).html());
                                        continue
                                    } else {
                                        if (id == "winnerSavings") {
                                            $("#winnerInfo_Savings").html(aD[id]);
                                            continue
                                        } else {
                                            if (id == "lastbidder") {
                                                $("#winning_" + s).html(aD[id]);
                                                continue
                                            } else {
                                                if (id == "avatar") {
                                                    $("#avatarimage").attr("src", aD[id]);
                                                    continue
                                                } else {
                                                    if (id == "bid_history") {
                                                        K(aD[id]);
                                                        ah(0);
                                                        continue
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } catch (aE) {
                        showConsole(aE, "JS Error")
                    }
                }
            }
        })
    };
    this.ajaxInterval = function () {
        try {
            if (Q == true) {
                showConsole("Updates paused...", null, 2);
                return
            }
            var aB = (new Date()).getTime();
            var aE = new Array();
            var az = 0;
            $.each(B, function (aF) {
                if (B[aF].grabid && (B[aF].state == "Active" || B[aF].state == "Paused") && (B[aF].timeleft2 < 60 || (B[aF].timeleft2 < 300 && aB - B[aF].lastupdate > 30000) || (B[aF].id == s && aB - B[aF].lastupdate > 15000) || (B[aF].id == s && B[aF].timeleft2 < 300) || (B[aF].state == "Paused" && aB - B[aF].lastupdate > 3000))) {
                    aE.push(B[aF].id)
                }
                if (B[aF].id == s) {
                    az = B[aF].version
                }
            });
            if (aE.length < 1) {
                return false
            }
            if (ssonly === false || (pageID != 1 && pageID != 2)) {
                var ay = "";
                if (!isDev) {
                    ay += (document.location.protocol == "https:" ? "https://" : "http://") + "ajax.quibids.com"
                }
                ay += "/ajax/u2.php?";
                if (R) {
                    ay += "&b=" + R
                }
                if (pageID && pageID > 0) {
                    ay += "&p=" + pageID
                }
                if (ac == "Paused") {
                    ay += "&paused=1"
                }
                if (s > 0) {
                    ay += "&lb_id=" + s;
                    ay += "&lb=" + az
                }
                if (bidoActive) {
                    ay += "&bido=1"
                }
                if (mm) {
                    ay += "&m=" + mm
                }
                ay += "&i=" + X(aE.sort(O).join(""));
                P = aB;
                $.ajax({
                    url: ay + "&c=?",
                    cache: true,
                    type: "get",
                    crossDomain: true,
                    dataType: "json",
                    timeout: 2000,
                    success: function (aF) {
                        A(aF, true)
                    },
                    error: function (aG, aH, aF) {
                        showConsole(aH, "AJAX Error")
                    }
                })
            }
            if (sson === true && (pageID == 1 || pageID == 2)) {
                if ((new Date().getTime()) - lastUpdateProcess > 2500) {
                    ssonly = false;
                    sson = false
                }
                if (ssonly === true && t == R && t != 0 && ai != 0 && C == false) {
                    C = true;
                    $.ajax({
                        url: "/api/bin/update.php?action=position",
                        cache: false,
                        type: "get",
                        crossDomain: true,
                        dataType: "xml",
                        timeout: 1000,
                        success: function (aG) {
                            C = false;
                            if (ai == 0) {
                                return
                            }
                            var aF = parseInt($(aG).find("position").text(), 10);
                            if (aF && aF - ai > 100) {
                                ssonly = false;
                                sson = false
                            }
                        },
                        error: function (aG, aH, aF) {
                            C = false;
                            ssonly = false;
                            sson = false;
                            showConsole(aH, "AJAX Error")
                        },
                        fail: function () {
                            C = false;
                            ssonly = false;
                            sson = false
                        }
                    })
                }
                try {
                    var ay = "";
                    if (!isDev) {
                        ay += (document.location.protocol == "https:" ? "https://" : "http://") + "s.quibids.com"
                    }
                    ay += "/ajax/u2.php?";
                    if (R) {
                        ay += "&b=" + R
                    }
                    if (pageID && pageID > 0) {
                        ay += "&p=" + pageID
                    }
                    if (ac == "Paused") {
                        ay += "&paused=1"
                    }
                    if (s > 0) {
                        ay += "&lb_id=" + s;
                        ay += "&lb=" + az
                    }
                    if (bidoActive) {
                        ay += "&bido=1"
                    }
                    if (mm) {
                        ay += "&m=" + mm
                    }
                    ay += "&i=" + X(aE.sort(O).join(""));
                    P = aB;
                    $.ajax({
                        url: ay + "&c=?",
                        cache: true,
                        type: "get",
                        crossDomain: true,
                        dataType: "json",
                        timeout: 2000,
                        success: function (aF) {
                            if (!aF || !aF.a) {
                                ssonly = false;
                                sson = false
                            }
                            if (ssonly === true) {
                                A(aF, true)
                            }
                        },
                        error: function (aG, aH, aF) {
                            ssonly = false;
                            sson = false;
                            showConsole(aH, "AJAX Error")
                        },
                        fail: function () {
                            ssonly = false;
                            sson = false
                        }
                    })
                } catch (aC) {
                    ssonly = false;
                    sson = false
                }
            }
            var aA = 1800000;
            if (ignoreOf) {
                aA = ignoreOfTimeout;
                if (!aA) {
                    aA = 3600000
                }
            }
            if (aB - f > aA) {
                Q = true;
                var aD = "<br/><br><div style='float:right;margin-top:10px'><input type='button' value=\"I'm Back!\" onclick='$(\"#popupModal\").dialog( \"close\" );location.reload(true);'></div>";
                $("#popupModal").html("<strong>You have not had any activity in 30 minutes, are you still here?</strong>" + aD);
                $(function () {
                    $("#popupModal").dialog({
                        modal: true,
                        title: "QuiBids Inactivity",
                        width: 300
                    })
                })
            }
        } catch (aC) {
            showConsole(aC, "JS Error")
        }
    };
    var O = function (az, ay) {
            var aA = parseInt(Math.random() * 10);
            var aB = aA % 2;
            var aC = aA > 5 ? 1 : -1;
            return (aB * aC)
        };
    var X = function (ay) {
            for (x = 10; x <= 35; x++) {
                ay = ay.replace(new RegExp(x, "g"), String.fromCharCode(x + 55))
            }
            for (x = 40; x <= 65; x++) {
                ay = ay.replace(new RegExp(x, "g"), String.fromCharCode(x + 57))
            }
            return ay
        };
    this.pu = function (ay) {
        A(ay, true)
    };
    var A = function (aB, az) {
            lastUpdateProcess = new Date().getTime();
            try {
                var ay = false;
                for (id in aB) {
                    try {
                        if (id == "a") {
                            aj(aB[id], az);
                            continue
                        } else {
                            if (id == "bidinfo") {
                                Auctions.updateBidsAvailable(aB[id], true);
                                continue
                            } else {
                                if (id == "realbids") {
                                    realBids = aB[id];
                                    ay = true;
                                    continue
                                } else {
                                    if (id == "freebids") {
                                        freeBids = aB[id];
                                        ay = true;
                                        continue
                                    } else {
                                        if (id == "realbidsvalue") {
                                            realBidsValue = aB[id];
                                            ay = true;
                                            continue
                                        } else {
                                            if (id == "bido" && bidoActive) {
                                                if (!$("#bido_num_show")) {
                                                    continue
                                                }
                                                if (aB[id].avail == "0") {
                                                    T();
                                                    continue
                                                }
                                                $("#bido_num_show").html(aB[id].avail + " / " + aB[id].num);
                                                continue
                                            } else {
                                                if (id == "bc") {
                                                    if (aB[id] != I && $("#bh_Bidders")) {
                                                        I = aB[id];
                                                        $("#bh_Bidders").html(I + " Bidder" + (I > 1 ? "s" : ""))
                                                    }
                                                    continue
                                                } else {
                                                    if (id == "bc_geo") {
                                                        if (isGeoEnabled) {
                                                            setTimeout("updateGeoMap('" + aB[id] + "')", 10)
                                                        }
                                                        continue
                                                    } else {
                                                        if (id == "message") {
                                                            av(aB[id]);
                                                            continue
                                                        } else {
                                                            if (id == "globalaccept") {
                                                                ag();
                                                                continue
                                                            } else {
                                                                if (id == "b" && aB[id] > 0) {
                                                                    t = R;
                                                                    R = parseInt(aB[id]);
                                                                    continue
                                                                } else {
                                                                    if (id == "bm" && aB[id] > 0) {
                                                                        ai = aB[id];
                                                                        continue
                                                                    } else {
                                                                        if (id == "officetotals" && pageID == 9) {
                                                                            if (aB[id].accounts) {
                                                                                $("#accountTotal").html(ar(aB[id].accounts))
                                                                            }
                                                                            if (aB[id].auctions) {
                                                                                $("#auctionTotal").html(ar(aB[id].auctions))
                                                                            }
                                                                            if (aB[id].bids) {
                                                                                $("#bidTotal").html(ar(aB[id].bids))
                                                                            }
                                                                            continue
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } catch (aC) {
                        showConsole(aC, "JS Error")
                    }
                }
                if (ay) {
                    L()
                }
                var aA = new Date();
                aa.push(aA.getTime() - P);
                if (aa.length > 5) {
                    aa.shift()
                }
                Auctions.updateConnectionSpeed()
            } catch (aC) {
                showConsole(aC, "JS Error")
            }
        };
    var aj = function (aD, ay) {
            try {
                var aC = (new Date()).getTime();
                var aF = 0;
                if (ay) {
                    aF = ((aC - P) / 1000);
                    if (aF < 0) {
                        aF = 0
                    } else {
                        if (aF > 0.6) {
                            aF = 0.6
                        }
                    }
                }
                var az = ae();
                for (id in aD) {
                    try {
                        var aA = az["a" + id];
                        var aB = null;
                        if (aD[id].constructor.toString().indexOf("Number") > 0) {
                            aB = aD[id]
                        } else {
                            if (aD[id].bidon) {
                                B[aA].bidon = aD[id].bidon
                            }
                            if (aD[id].p) {
                                if (B[aA].bidon > 0) {
                                    if (aD[id].p >= B[aA].bidon) {
                                        B[aA].bidon = -1;
                                        B[aA].price = aD[id].p
                                    }
                                } else {
                                    B[aA].price = aD[id].p
                                }
                            }
                            if (aD[id].v) {
                                if (B[aA].version < aD[id].v) {
                                    B[aA].version = aD[id].v;
                                    if (id == s) {
                                        p = B[aA].version
                                    }
                                }
                            }
                            if (B[aA] && B[aA].bidon <= B[aA].price && aD[id]) {
                                if (aD[id].lb) {
                                    B[aA].bidder = aD[id].lb
                                }
                                if (aD[id].av) {
                                    B[aA].avatar = aD[id].av
                                }
                            }
                            if (aD[id].s) {
                                if (B[aA].bidon != -1 && B[aA].bidon < B[aA].price) {
                                    B[aA].bidon = -1
                                }
                                if (B[aA].state != "Active" || (B[aA].state == "Active" && B[aA].bidon == -1)) {
                                    B[aA].state = aD[id].s
                                }
                                if (ac != B[aA].state) {
                                    ac = B[aA].state
                                }
                                if (B[aA].state == "Completed" && W) {
                                    if (pageID == 1) {
                                        if (!reloadTimeout) {
                                            reloadTimeout = setTimeout("Auctions.reloadAuctions()", 1000 * 20)
                                        }
                                    } else {
                                        if (pageID == 2 && B[aA].id != s) {
                                            if (!reloadTimeout) {
                                                reloadTimeout = setTimeout("Auctions.reloadAuctions()", 1000 * 20)
                                            }
                                        } else {
                                            if (pageID == 9) {
                                                if (!reloadTimeout) {
                                                    reloadTimeout = setTimeout("Auctions.reloadAuctions()", 1000 * 5)
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    if (!W) {
                                        W = true
                                    }
                                }
                            }
                            if (aD[id].sl != undefined) {
                                aB = aD[id].sl
                            }
                            if (aD[id].bh && aD[id].bh.length > 0) {
                                K(aD[id].bh, B[aA].price)
                            }
                        }
                        if (aB != undefined) {
                            aB -= aF;
                            B[aA].timeleft = aB;
                            B[aA].timeleft2 = aB;
                            B[aA].lasttimeupdate = aC
                        }
                        B[aA].lastupdate = aC
                    } catch (aE) {
                        showConsole(aE, "JS Error")
                    }
                }
            } catch (aE) {
                showConsole(aE, "JS Error")
            }
            if (d) {
                Auctions.displayInterval()
            }
        };
    var K = function (aF, ay) {
            $.each(aF, function (aG, aH) {
                if (aH.id > V) {
                    V = aH.id
                }
                an["a" + aH.id] = aH
            });
            var aE = 0;
            for (var aD in an) {
                aE++
            }
            if (ay && aE > 15) {
                var aC = (ay - (M * 15)) * 100;
                var aB = new Array();
                for (var aA in an) {
                    var az = an[aA];
                    if (az.id >= aC) {
                        aB["a" + az.id] = az
                    }
                }
                an = aB
            }
        };
    this.displayInterval = function () {
        var ay = (new Date()).getTime();
        if (Q == true) {
            showConsole("Updates paused...", null, 2);
            return
        }
        $.each(B, function (aQ) {
            if (B[aQ] == undefined) {
                return
            }
            try {
                if (!B[aQ].id) {
                    return
                }
                if (B[aQ].timeleft == -1 && (B[aQ].status == "Completed" && B[aQ].laststate != "")) {
                    return
                }
                var aR = (B[aQ].id == s ? "2" : "");
                var aA = B[aQ].state;
                var aI = B[aQ].id;
                var aL = B[aQ].price;
                var aE = B[aQ].bidder;
                var aM = B[aQ].timeleft;
                if (aA == "Completed" && B[aQ].laststate == "Completed") {
                    return
                }
                var aH = (ay - B[aQ].lasttimeupdate) / 1000;
                if (B[aQ].lasttimeupdate > 100000 && aM > -1) {
                    B[aQ].timeleft2 = aM - aH;
                    if (aM > 19.8 && aM < 20.1) {} else {
                        if (aM > 14.8 && aM < 15.1) {} else {
                            if (aM > 9.8 && aM < 10.1) {} else {
                                aM -= aH
                            }
                        }
                    }
                }
                if (aM == -1 && B[aQ].laststate == "" && aA == "Active") {
                    return
                }
                if (aA == "Active" && aM < 1) {
                    aM = 1
                }
                if (ac == "Paused" && B[aQ].state != "Completed") {
                    aA = "Paused"
                }
                if (ac != "Paused" && B[aQ].state == "Paused") {
                    if (!reloadPauseTimeout) {
                        var aT = Math.floor(Math.random() * 6);
                        reloadPauseTimeout = setTimeout("location.reload(true);", 1000 * aT)
                    }
                    B[aQ].state = "Active"
                }
                var aX = new Array("" + B[aQ].id + "");
                if (B[aQ].slocation) {
                    aX[aX.length] = B[aQ].id + "s"
                }
                for (var aK = 0; aK < aX.length; aK++) {
                    var aW = aX[aK];
                    if ((Math.round(B[aQ].lasttime) != Math.round(aM) && aM > -1) || aA == "Completed" || aA == "Paused") {
                        var aS = "#timer_" + aW;
                        if ($(aS) && aM > 0 && aA == "Active") {
                            if (!$(aS).hasClass("timer" + aR)) {
                                $(aS).toggleClass("timer" + aR)
                            }
                            if (aR == "2") {
                                clockTime = aM
                            }
                            if (aM <= 10) {
                                if (!$(aS).hasClass("timer_10togo")) {
                                    $(aS).toggleClass("timer_10togo")
                                }
                                if (aR && $(aS).hasClass("timer" + aR)) {
                                    $(aS).removeClass("timer" + aR)
                                }
                                if (!aR && $(aS).hasClass("timer" + aR)) {
                                    $(aS).removeClass("timer" + aR)
                                }
                                if (aR && !$(aS).hasClass("timer2ending")) {
                                    $(aS).toggleClass("timer2ending")
                                }
                                if ($(aS).hasClass("time-left")) {
                                    $(aS).removeClass("time-left")
                                }
                                if (!$(aS).hasClass("time-leftending")) {
                                    $(aS).toggleClass("time-leftending")
                                }
                            } else {
                                if ($(aS).hasClass("timer_10togo")) {
                                    $(aS).removeClass("timer_10togo")
                                }
                                if ($(aS).hasClass("time-leftending")) {
                                    $(aS).removeClass("time-leftending")
                                }
                                if (!$(aS).hasClass("time-left")) {
                                    $(aS).toggleClass("time-left")
                                }
                                if (aR == "2" && $(aS).hasClass("timer2ending")) {
                                    $(aS).removeClass("timer2ending")
                                }
                            }
                            var aC = "";
                            if (aM < 1) {
                                aM = 1
                            }
                            aM = Math.round(aM);
                            var aF = 0;
                            aF = parseInt(aM / 3600);
                            aC += ((aF > 9) ? "" : "0") + aF + ":";
                            aF = parseInt((aM / 60) % 60);
                            aC += ((aF > 9) ? "" : "0") + aF + ":";
                            aF = Math.round(aM % 60);
                            aC += ((aF > 9) ? "" : "0") + aF;
                            $(aS).html(aC);
                            if (aR) {
                                a = (aM - aq);
                                if (a < 0) {
                                    a = 0
                                }
                            }
                        } else {
                            if ((aA == "Paused" || ac == "Paused") && $(aS)) {
                                if (!$(aS).hasClass("ended" + aR)) {
                                    $(aS).toggleClass("ended" + aR)
                                }
                                if ($(aS)) {
                                    $(aS).html("--:--:--")
                                }
                                if ($(aS + "2")) {
                                    $(aS + "2").html("--:--:--")
                                }
                            } else {
                                if ($(aS) && aA == "Completed") {
                                    if (!$(aS).hasClass("ended" + aR)) {
                                        $(aS).toggleClass("ended" + aR)
                                    }
                                    $(aS).html("<font color='silver'>Ended</font>");
                                    if (aR == "2") {
                                        clockTime = 0
                                    }
                                }
                            }
                        }
                    }
                    if (B[aQ].laststate != aA) {
                        var aO = "#button_" + aW;
                        if (aA == "Completed") {
                            var aG = "#soldtag_" + aW;
                            if ($(aG) && !$(aG).hasClass("sold-stamp-visible")) {
                                $(aG).toggleClass("sold-stamp-visible")
                            }
                            if ($(aO)) {
                                if ($(aO).hasClass("paused")) {
                                    $(aO).removeClass("paused")
                                }
                                if ($(aO).hasClass("bid-logged")) {
                                    $(aO).removeClass("bid-logged")
                                }
                                if ($(aO).hasClass("bid")) {
                                    $(aO).removeClass("bid")
                                }
                                if ($(aO).hasClass("bidonme")) {
                                    $(aO).removeClass("bidonme")
                                }
                                if ($(aO).hasClass("bidonme_orange")) {
                                    $(aO).removeClass("bidonme_orange")
                                }
                                if ($(aO).hasClass("loginfirst")) {
                                    $(aO).removeClass("loginfirst")
                                }
                                if ($(aO).hasClass("loginfirst_orange")) {
                                    $(aO).removeClass("loginfirst_orange")
                                }
                                if ($(aO).hasClass("bidonme_small")) {
                                    $(aO).removeClass("bidonme_small")
                                }
                                if (aI != s) {
                                    if (!$(aO).hasClass("sold")) {
                                        $(aO).toggleClass("sold")
                                    }
                                }
                            }
                            if (pageID == 2 && aI == s) {}
                            aM = 0
                        } else {
                            if ($(aO) && aA == "Paused") {
                                if ($(aO).hasClass("bid-logged")) {
                                    $(aO).removeClass("bid-logged")
                                }
                                if ($(aO).hasClass("bid")) {
                                    $(aO).removeClass("bid")
                                }
                                if ($(aO).hasClass("bidonme")) {
                                    $(aO).removeClass("bidonme")
                                }
                                if ($(aO).hasClass("bidonme_orange")) {
                                    $(aO).removeClass("bidonme_orange")
                                }
                                if ($(aO).hasClass("loginfirst")) {
                                    $(aO).removeClass("loginfirst")
                                }
                                if ($(aO).hasClass("loginfirst_orange")) {
                                    $(aO).removeClass("loginfirst_orange")
                                }
                                if ($(aO).hasClass("bidonme_small")) {
                                    $(aO).removeClass("bidonme_small")
                                }
                                if (!$(aO).hasClass("paused")) {
                                    $(aO).toggleClass("paused")
                                }
                            } else {
                                if ($(aO) && aA == "Active" && s == aI && !aO.endsWith("s")) {
                                    if ($(aO).hasClass("paused")) {
                                        $(aO).removeClass("paused")
                                    }
                                    if (loggedIn) {
                                        if (!$(aO).hasClass("bid-logged")) {
                                            $(aO).toggleClass("bid-logged")
                                        }
                                    } else {
                                        if (!$(aO).hasClass("bid")) {
                                            $(aO).toggleClass("bid")
                                        }
                                    }
                                } else {
                                    if ($(aO) && aA == "Active") {
                                        if ($(aO).hasClass("paused")) {
                                            $(aO).removeClass("paused")
                                        }
                                        if (loggedIn) {
                                            if (aO.endsWith("s") && !$(aO).hasClass("bidonme_orange")) {
                                                $(aO).toggleClass("bidonme_orange")
                                            } else {
                                                if (!aO.endsWith("s") && !$(aO).hasClass("bidonme")) {
                                                    $(aO).toggleClass("bidonme")
                                                }
                                            }
                                        } else {
                                            if (aO.endsWith("s") && !$(aO).hasClass("loginfirst_orange")) {
                                                $(aO).toggleClass("loginfirst_orange")
                                            } else {
                                                if (!aO.endsWith("s") && !$(aO).hasClass("loginfirst")) {
                                                    $(aO).toggleClass("loginfirst")
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (B[aQ].lastprice != aL) {
                        var aD = "#price_" + aW;
                        var aP = parseCurrency(aL);
                        var aB = formatPrice(aP);
                        if (s == aW) {
                            aB = aB + ' <span class="last-price-currency">' + cCode + "</span>"
                        }
                        if ($(aD) && $(aD).html() != aB) {
                            $(aD).html(aB);
                            if (!d && aL > 0 && B[aQ].lastprice != -1) {
                                var aV = "#fadb7d";
                                var aJ = 900;
                                if (B[aQ].lasttime < 2) {
                                    aV = "#e26969";
                                    aJ = 1200
                                } else {
                                    if (B[aQ].lasttime < 10) {
                                        aV = "#f1a43f";
                                        aJ = 1100
                                    }
                                }
                                $(aD).clearQueue();
                                $(aD).css("background-color", "");
                                $(aD).effect("highlight", {
                                    color: aV
                                }, aJ)
                            }
                        }
                    }
                    if (B[aQ].lastbidder != aE && aE) {
                        var aN = "#winning_" + aW;
                        if (aE == "") {
                            aE = "No Bids Yet!"
                        }
                        if ($(aN)) {
                            $(aN).html(aE)
                        }
                        if (aR == "2") {
                            var az = "default";
                            if (B[aQ].avatar) {
                                az = B[aQ].avatar
                            }
                            if ($("#avatarimage")) {
                                $("#avatarimage").attr("src", "http://s1.quibidscdn.com/n1/avatards/" + az + ".png")
                            }
                        }
                    }
                }
                if (s == aI) {
                    if (aL > H) {
                        H = aL;
                        L()
                    }
                    if (B[aQ].version && B[aQ].version > p) {
                        p = B[aQ].version
                    }
                    aq = aM;
                    if (k != V || aA == "Completed") {
                        ah()
                    }
                    if (B[aQ].version != J) {
                        if ($("#clockImage").hasClass("clock10")) {
                            $("#clockImage").removeClass("clock10")
                        }
                        if ($("#clockImage").hasClass("clock15")) {
                            $("#clockImage").removeClass("clock15")
                        }
                        if ($("#clockImage").hasClass("clock20")) {
                            $("#clockImage").removeClass("clock20")
                        }
                        if (B[aQ].version >= h) {
                            if (!$("#clockImage").hasClass("clock10")) {
                                $("#clockImage").toggleClass("clock10")
                            }
                        } else {
                            if (B[aQ].version >= F) {
                                if (!$("#clockImage").hasClass("clock15")) {
                                    $("#clockImage").toggleClass("clock15")
                                }
                            } else {
                                if (!$("#clockImage").hasClass("clock20")) {
                                    $("#clockImage").toggleClass("clock20")
                                }
                            }
                        }
                        J = B[aQ].version
                    }
                }
                if (aA == "Completed" && aE == accountUsername && B[aQ].bidon > 0 && (typeof isSearchResults === "undefined")) {
                    setTimeout("location.href='/auctions/" + aI + "-winner';", 1000 * 2)
                }
                B[aQ].lastbidder = aE;
                B[aQ].lastprice = aL;
                B[aQ].lasttime = aM;
                B[aQ].laststate = aA
            } catch (aU) {
                showConsole(aU, "JS Error")
            }
        });
        d = false
    };
    var am = function () {
            Y = null
        };
    var ae = function () {
            if (Y) {
                return Y
            }
            var ay = new Array();
            $.each(B, function (az) {
                ay["a" + B[az].id] = az
            });
            Y = ay;
            return ay
        };
    var ah = function (aE) {
            try {
                for (var aB = 1; aB < 10; aB++) {
                    var az = "";
                    var aC = "";
                    var aF = "";
                    var ay = p - (aw * (aB - 1));
                    if (ay <= l) {
                        continue
                    }
                    var aA = "a" + Math.round(p - (aw * (aB - 1)));
                    if (an[aA]) {
                        az = an[aA].u;
                        aF = an[aA].a;
                        if (an[aA].t == 1) {
                            aC = "Single"
                        } else {
                            if (an[aA].t == 2) {
                                aC = "BidOMatic"
                            }
                        }
                    } else {
                        aF = "";
                        az = "N/A";
                        aC = "N/A"
                    }
                    $("#bhp_" + aB).html(aF);
                    $("#bhb_" + aB).html(az);
                    $("#bht_" + aB).html(aC)
                }
                var aE = 0;
                if (V > 0 && V - k > 0) {
                    aE = Math.round((V - k) / 100 / M)
                }
                if (aE == H * 100) {
                    aE = 0
                }
                ak(aE);
                if (!d) {
                    $("#bh_active").clearQueue();
                    $("#bh_active").css("background-color", "");
                    $("#bh_active").effect("highlight", {
                        color: "#ffff99"
                    }, 400);
                    if ($("#bh_Bids")) {
                        $("#bh_Bids").html(aE + " Bid" + (aE > 1 ? "s" : ""))
                    }
                    if ($("#bh_BidsInfo")) {
                        $("#bh_BidsInfo").html(formatPrice(parseCurrency(M * aE)) + " + " + a + " seconds")
                    }
                    if (ap) {
                        clearTimeout(ap);
                        ax += aE;
                        al += M * aE;
                        ab += Math.round(a)
                    } else {
                        ax = aE;
                        al = M * aE;
                        ab = Math.round(a)
                    }
                    if ($("#bh_Bids")) {
                        $("#bh_Bids").html(ax + " Bid" + (ax > 1 ? "s" : ""))
                    }
                    if ($("#bh_BidsInfo")) {
                        $("#bh_BidsInfo").html(formatPrice(parseCurrency(M * ax)) + " + " + ab + " seconds")
                    }
                    $("#bh_Bids").show();
                    $("#bh_BidsInfo").show();
                    ap = setTimeout("Auctions.fadeBidInfoText()", 1000)
                }
                k = V
            } catch (aD) {
                showConsole(aD, "JS Error")
            }
        };
    this.lateBidSwitch = function () {
        if ($("#costs")) {
            $("#costs").html("")
        }
        ao = null
    };
    this.fadeBidInfoText = function () {
        $("#bh_Bids").fadeOut(200, function () {
            $("#bh_Bids").html("");
            $("#bh_Bids").attr("display", "block")
        });
        $("#bh_BidsInfo").fadeOut(200, function () {
            $("#bh_BidsInfo").html("");
            $("#bh_BidsInfo").attr("display", "block")
        });
        ap = null
    };
    this.reloadAuctions = function () {
        var az = new Date();
        if (reloadTimeout) {
            clearTimeout(reloadTimeout)
        }
        reloadTimeout = null;
        if (pageID == 1) {
            var ay = "/ajax/spots.php?action=reloadAuctions&pageID=1";
            if (u.endingspot.length > 0) {
                ay += "&zs=" + u.endingspot.join(",")
            }
            $.ajax({
                url: ay,
                cache: false,
                dataType: "json",
                success: function (aD) {
                    var aA = true;
                    for (id in aD) {
                        if (id == "Beginner" || id == "Live" || id == "EndingSoon") {
                            aA = true;
                            break
                        }
                    }
                    var aF = B.slice(0);
                    if (aA) {
                        for (id in aD) {
                            if (id == "Beginner" || id == "Live" || id == "EndingSoon") {
                                var aG = "";
                                if (id == "Beginner") {
                                    aG = "beginnerspot"
                                } else {
                                    if (id == "Live") {
                                        aG = "livespot"
                                    } else {
                                        if (id == "EndingSoon") {
                                            aG = "endingspot"
                                        }
                                    }
                                }
                                if (aG == "") {
                                    continue
                                }
                                Auctions.unregisterAuctionSpots(aG)
                            }
                        }
                    }
                    for (id in aD) {
                        if (id == "Beginner" || id == "Live" || id == "EndingSoon") {
                            var aG = "";
                            if (id == "Beginner") {
                                aG = "beginnerspot"
                            } else {
                                if (id == "Live") {
                                    aG = "livespot"
                                } else {
                                    if (id == "EndingSoon") {
                                        aG = "endingspot"
                                    }
                                }
                            }
                            if (aG == "") {
                                continue
                            }
                            var aB = 1;
                            for (spotID in aD[id]) {
                                var aE = aD[id][spotID];
                                if (aE.id && aE.id > 0 && $("#" + aG + "_" + aB)) {
                                    $("#" + aG + "_" + aB).html(aE.html);
                                    if (aE.status == "Active") {
                                        var aC = Auctions.registerAuctionSpot(aE.id, aG, aE.status);
                                        $.each(aF, function (aH) {
                                            if (aF[aH].id && aF[aH].id == B[aC].id) {
                                                B[aC].state = aF[aH].state;
                                                B[aC].timeleft = aF[aH].timeleft;
                                                B[aC].timeleft2 = aF[aH].timeleft2;
                                                B[aC].bidder = aF[aH].bidder;
                                                B[aC].price = aF[aH].price;
                                                B[aC].version = aF[aH].version;
                                                B[aC].lastupdate = aF[aH].lastupdate;
                                                B[aC].lastprice = aF[aH].lastprice;
                                                B[aC].laststate = aF[aH].laststate;
                                                B[aC].lastbidder = aF[aH].lastbidder;
                                                B[aC].lasttimeupdate = aF[aH].lasttimeupdate;
                                                B[aC].lasttime = aF[aH].lasttime;
                                                B[aC].bidon = aF[aH].bidon;
                                                return false
                                            }
                                        })
                                    }
                                    aB++
                                }
                            }
                            for (x = aB; x <= 100; x++) {
                                if (!$("#" + aG + "_" + x)) {
                                    break
                                }
                                $("#" + aG + "_" + x).html("")
                            }
                        }
                    }
                    Auctions.resetBIN()
                }
            })
        } else {
            if (pageID == 2) {
                var ay = "/ajax/spots.php?action=reloadAuctions&pageID=2&ignoreID=" + s + "";
                if (u.topspot.length > 0) {
                    ay += "&zs=" + u.topspot.join(",")
                }
                $.ajax({
                    url: ay,
                    cache: false,
                    dataType: "json",
                    success: function (aB) {
                        Auctions.unregisterAuctionSpots("topspot");
                        var aA = 1;
                        for (id in aB) {
                            if (aB[id].id && aB[id].id > 0) {
                                $("#topspot_" + aA).html(aB[id].html);
                                if (aB[id].status == "Active") {
                                    Auctions.registerAuctionSpot(aB[id].id, "topspot")
                                }
                                aA++
                            }
                        }
                        Auctions.resetBIN()
                    }
                })
            } else {
                if (pageID == 9) {
                    var ay = "/ajax/spots.php?action=reloadAuctions&pageID=9";
                    $.ajax({
                        url: ay,
                        cache: false,
                        dataType: "json",
                        success: function (aB) {
                            Auctions.unregisterAuctionSpots("endingspot");
                            for (id in aB) {
                                if (id == "EndingSoon") {
                                    var aD = "";
                                    if (id == "EndingSoon") {
                                        aD = "endingspot"
                                    }
                                    if (aD == "") {
                                        continue
                                    }
                                    var aA = 1;
                                    for (spotID in aB[id]) {
                                        var aC = aB[id][spotID];
                                        if (aC.id && aC.id > 0 && $("#" + aD + "_" + aA)) {
                                            $("#" + aD + "_" + aA).html(aC.html);
                                            if (aC.status == "Active") {
                                                Auctions.registerAuctionSpot(aC.id, aD)
                                            }
                                            aA++
                                        }
                                    }
                                    for (x = aA; x <= 200; x++) {
                                        if (!$("#" + aD + "_" + x)) {
                                            break
                                        }
                                        $("#" + aD + "_" + x).html("")
                                    }
                                }
                            }
                            Auctions.resetBIN()
                        }
                    })
                }
            }
        }
    };
    this.placeBid = function (aA, az) {
        if (!loggedIn) {
            alert("You are not logged in!");
            return
        }
        if (y) {
            alert("These auctions are just for simulation.");
            return
        }
        if (q == aA && G + 250 > (new Date()).getTime()) {
            return
        }
        G = (new Date()).getTime();
        f = G;
        q = aA;
        var ay = "/ajax/bid2.php?id=" + aA;
        if (az) {
            ay += "&p=" + az
        } else {
            if (pageID && pageID > 0) {
                ay += "&p=" + pageID
            }
        }
        if (s > 0) {
            ay += "&lb_id=" + s + "&lb=" + V
        }
        $.ajax({
            url: ay,
            cache: false,
            dataType: "json",
            success: function (aB) {
                A(aB)
            }
        })
    };
    this.updateBidsAvailable = function (aB, ay) {
        try {
            bidsAvailable = aB.Total;
            if ($("#bids_available")) {
                $("#bids_available").html(bidsAvailable)
            }
            bidsAvailable_Real = aB.Real;
            if ($("#bids_available2")) {
                var az = bidsAvailable_Real + " Real / " + bidsAvailable_Free + " Voucher Left";
                $("#bids_available2").attr("title", az)
            }
            bidsAvailable_Free = aB.Free;
            if ($("#bids_available2")) {
                var az = bidsAvailable_Real + " Real / " + bidsAvailable_Free + " Voucher Left";
                $("#bids_available2").attr("title", az)
            }
            try {
                if (ay) {
                    QBar.updateBidsAvailable(aB)
                }
            } catch (aA) {}
        } catch (aA) {
            showConsole(aA, "JS Error")
        }
    };
    var L = function () {
            try {
                var ay = parseCurrency(H);
                var aA = parseCurrency(realBidsValue);
                var aE = e - H - realBidsValue;
                if (aE < 0) {
                    aE = 0
                }
                var aC = parseCurrency(aE);
                if ($("#price2")) {
                    $("#price2").html(ay + "")
                }
                if ($("#saving")) {
                    $("#saving").html(formatPrice(aC))
                }
                if ($("#savings2")) {
                    $("#savings2").html(ar(aC))
                }
                if ($("#bido_from") && ($("#bido_from").val() == "" || $("#bido_from").val() < H)) {
                    $("#bido_from").val(ay)
                }
                if ($("#realBidsValue1")) {
                    $("#realBidsValue1").html(aA)
                }
                if ($("#realBidsValue2")) {
                    $("#realBidsValue2").html(aA)
                }
                if ($("#realBids")) {
                    var az = "";
                    if (freeBids == 0) {
                        az = realBids + " Bids"
                    } else {
                        az = realBids + " Bids (" + freeBids + " Voucher)"
                    }
                    $("#realBids").html(az)
                }
                if ($("#buyItNowPrice")) {
                    var aB = e - realBidsValue;
                    if (aB < 0) {
                        aB = 0
                    }
                    $("#buyItNowPrice").html(ar(parseCurrency(aB)))
                }
            } catch (aD) {
                showConsole(aD, "JS Error")
            }
        };
    var ar = function (az) {
            az += "";
            x = az.split(".");
            x1 = x[0];
            x2 = x.length > 1 ? "." + x[1] : "";
            var ay = /(\d+)(\d{3})/;
            while (ay.test(x1)) {
                x1 = x1.replace(ay, "$1,$2")
            }
            return x1 + x2
        };
    this.getPauseState = function () {
        return Q
    };
    this.checkWatched = function () {
        try {
            var ay = "/ajax/watch.php?action=check";
            $.ajax({
                url: ay,
                cache: false,
                success: function (aA) {
                    if (aA == 1) {
                        hasWatchedAuctions = true
                    } else {
                        hasWatchedAuctions = false
                    }
                }
            })
        } catch (az) {
            showConsole(az, "JS Error")
        }
        return false
    };
    this.addWatched = function (aB, aA) {
        try {
            var ay = "/ajax/watch.php?action=add&auctionid=" + aB;
            $.ajax({
                url: ay,
                cache: false,
                success: function (aE) {
                    var aD = false;
                    if (readCookie("watchNotificationDisabled")) {
                        aD = true
                    }
                    if ($("#watch_" + aB) && aB == s) {
                        $("#watch_" + aB).html('<a href="#" onclick="Auctions.removeWatched(' + aB + ',false);return false;" class="view-all-btn">Remove from watchlist</a>')
                    } else {
                        if ($("#watch_" + aB)) {
                            $("#watch_" + aB).html('<img src="http://s1.quibidscdn.com/images/watch_remove.png" onclick="Auctions.removeWatched(' + aB + ');"> <a href="#" onclick="Auctions.removeWatched(' + aB + ');return false;">Remove From Watch List</a>')
                        }
                    }
                    if (!aD || aA) {
                        var aC = "Auction added to your watch list!<br><br><a href='/account/index.php'><img src='http://s1.quibidscdn.com/images/watch_add.png' border='0'> View Watch List</a> <small><br><br><input type='checkbox' onchange='Auctions.changeWatchNotification();' id='notificationCheckbox'>Hide this popup notification?</small>";
                        popupInfoMsg(aC, "Auction Watch List")
                    }
                    hasWatchedAuctions = true
                }
            });
            f = (new Date()).getTime()
        } catch (az) {
            showConsole(az, "JS Error")
        }
        return false
    };
    this.changeWatchNotification = function () {
        var ay = false;
        if ($("#notificationCheckbox:checked").val() == "on") {
            ay = true
        }
        createCookie("watchNotificationDisabled", ay, 180)
    };
    this.removeWatched = function (aB, az) {
        try {
            var ay = "/ajax/watch.php?action=delete&auctionid=" + aB;
            $.ajax({
                url: ay,
                cache: false,
                success: function (aC) {
                    if (az) {
                        location.reload(true)
                    } else {
                        if (removeWatchedDiv) {
                            if ($("#auction_" + aB)) {
                                $("#auction_" + aB).hide()
                            }
                            Auctions.unregisterAuction(aB)
                        } else {
                            if ($("#watch_" + aB) && aB == s) {
                                $("#watch_" + aB).html('<a href="#" onclick="Auctions.addWatched(' + aB + ');return false;" class="view-all-btn">Add auction to watchlist</a>')
                            } else {
                                if ($("#watch_" + aB)) {
                                    $("#watch_" + aB).html('<img src="http://s1.quibidscdn.com/images/watch_add.png" onclick="Auctions.addWatched(' + aB + ');"> <a href="#" onclick="Auctions.addWatched(' + aB + ');return false;">Add To Watch List</a>')
                                }
                            }
                        }
                        if (Number(aC) === 0) {
                            hasWatchedAuctions = false
                        }
                        return
                    }
                }
            });
            f = (new Date()).getTime()
        } catch (aA) {
            showConsole(aA, "JS Error")
        }
        return false
    };
    var S;
    var o = function (ay) {
            if (!S) {
                ad()
            }
            while (true) {
                var az = S[Math.floor(Math.random() * S.length)];
                if (!ay || az != ay) {
                    return az
                }
            }
        };
    var ad = function () {
            S = new Array("MrKerryon", "johnny1965", "ilywamhala", "kristenlc", "mobethea", "overlordbast", "vanmom11763", "Tcotton1127", "tdkurtz", "ricky6921", "sbruck", "Renegade20", "dogman081", "highball49", "cwright4u", "hpwitoyo", "cluttrull", "ambernicole6", "tjjom", "pfscorpio", "billbridges", "rltipton", "blmtsi", "RSKI50", "borr04", "dmolina22703", "wrx1949", "richjanet", "auntien", "Mayu0218", "rocadoodle", "wildcats1997", "RNbid1", "Juzo4k", "scotlcky13", "SkidMarc", "suedoe", "rodapi", "photopro", "mabboys", "xecor27", "Lottodude", "Makkbiz", "musicmattps", "dochog2", "anani1106", "joeylig", "hfidler", "riteshn3", "aramiscal", "psymons919", "LevIra", "ceh06", "okenid02", "jbpen", "debbietg", "jdub3033", "bobbym1232", "cgudeman", "fgoldberg", "patotong", "Uziekalla", "arlotobin", "rodh7829", "Roarn", "Ginny2010", "vince62", "JGman09", "flh1979", "fkostoff", "blainoman", "Papos5", "dzuels", "eluedt", "SimonV", "mjf1386", "hherrera", "bevbu913", "Tjackson1979", "kceee", "jj007g", "siroreo417", "h2ofile", "Coinshot", "vonRogue", "dudethtgamez", "leesputer", "vinh928", "chasD90", "aeichman101", "COSMO22", "KIMIM891", "ghost33", "roadknight", "paulsnc", "randyjuve", "IREFLYCS", "Karpediem", "blueartk", "kmbar")
        };
    this.simulationInterval = function () {
        try {
            var ay = (new Date()).getTime();
            $.each(B, function (aA) {
                B[aA].timeleft -= 1;
                if (B[aA].timeleft < 10 && (1 == Math.floor(Math.random() * (B[aA].timeleft + 3)) || B[aA].timeleft < 1)) {
                    B[aA].timeleft = 15;
                    B[aA].price = B[aA].price + 0.00;
                    B[aA].bidder = o(B[aA].bidder)
                }
            })
        } catch (az) {
            showConsole(az, "JS Error")
        }
    };
    this.processBido = function () {
        try {
            var ay = [];
            v("bido_from", false);
            v("bido_num", false);
            if ($("#bido_from").val() == "") {
                ay.push("Enter a starting bid! It must be larger than the current price of " + parseCurrency(H) + ".");
                v("bido_from", true)
            }
            if ($("#bido_num").val() == "" || parseFloat($("#bido_num").val()) < 3) {
                ay.push("You must specify at least 3 automatic bids.");
                v("bido_num", true)
            } else {
                if (parseFloat($("#bido_num").val()) > bidsAvailable) {
                    ay.push("You do not have enough bids credits. You only have " + bidsAvailable + " bids left in your account.");
                    v("bido_num", true)
                } else {
                    if (parseFloat($("#bido_num").val()) > 25) {
                        ay.push("You are not allowed to use more than 25 bids for a BidOMatic.");
                        v("bido_num", true)
                    }
                }
            }
            if (ay.length == 0) {
                var aC = new Date();
                var az = "/ajax/bidomatic2.php?auctionid=" + s + "&bido_from=" + $("#bido_from").val() + "&bido_num=" + parseFloat($("#bido_num").val());
                $.ajax({
                    url: az,
                    cache: false,
                    dataType: "json",
                    success: D
                })
            } else {
                var aA = '<strong>The following errors occured:</strong><ul style="margin-left:10px">';
                for (var aB = 0; aB < ay.length; aB++) {
                    aA += "<li>" + ay[aB] + "</li>"
                }
                aA += "</ul>";
                popupErrorMsg(aA, "Bid-O-Matic Setup")
            }
            f = (new Date()).getTime()
        } catch (aD) {
            showConsole(aD, "JS Error")
        }
        return false
    };
    var D = function (az) {
            try {
                if (az.errorText) {
                    popupErrorMsg("There was an error processing your request: " + az.errorText, "Bid-O-Matic Message");
                    return
                }
                if (az.message) {
                    av(az.message);
                    return
                }
                if (az.globalaccept) {
                    ag();
                    return
                }
                var aA = 0;
                if (!az.num || !az.avail) {
                    popupErrorMsg("There was an error processing your request.", "Bid-O-Matic Message");
                    return
                }
                $("#bido_from_show").html(formatPrice(parseCurrency(az.from)));
                $("#bido_num_show").html(az.avail + " / " + az.num);
                $("#bido_from").val(H.toFixed(2));
                var ay = bidsAvailable;
                if (ay > 25) {
                    ay = 25
                } else {
                    if (ay < 1) {
                        ay = 0
                    }
                }
                $("#bido_num").val(ay);
                $("#bido_overview").css("display", "block");
                $("#bido_setup").css("display", "none");
                bidoActive = true
            } catch (aB) {
                showConsole(aB, "JS Error")
            }
        };
    var T = function () {
            try {
                bidoActive = false;
                $("#bido_overview").css("display", "none");
                $("#bido_setup").css("display", "block");
                $("#bido_from_show").html("");
                $("#bido_num_show").html("");
                var ay = bidsAvailable;
                if (ay > 25) {
                    ay = 25
                } else {
                    if (ay < 1) {
                        ay = 0
                    }
                }
                $("#bido_num").html("" + ay + "");
                $("#bido_from").html(parseCurrency(H))
            } catch (az) {
                showConsole(az, "JS Error")
            }
        };
    this.removeBido = function () {
        try {
            var ay = "/ajax/bidomatic2.php?action=delete&auctionid=" + s;
            $.ajax({
                url: ay,
                cache: false,
                dataType: "json",
                success: function (aA) {
                    bidoActive = false;
                    popupErrorMsg("Your Bid-O-Matic was successfully deactivated.", "Bid-O-Matic Message");
                    T()
                }
            });
            f = (new Date()).getTime()
        } catch (az) {
            showConsole(az, "JS Error")
        }
        return false
    };
    var av = function (aB) {
            var aA = (aB.once == "1" ? true : false);
            if (aB.type == "Error") {
                if (!m["" + aB.id + ""]) {
                    popupErrorMsg(aB.msg, aB.id, aB.width)
                }
                if (aA) {
                    m["" + aB.id + ""] = true
                }
            } else {
                if (aB.type == "Info") {
                    if (!m["" + aB.id + ""]) {
                        popupInfoMsg(aB.msg, aB.id, aB.width)
                    }
                    if (aA) {
                        m["" + aB.id + ""] = true
                    }
                } else {
                    if (aB.type == "Image") {
                        var aC = aB.url;
                        var az = aB.width;
                        var ay = aB.height;
                        if (!m["" + aC + ""]) {
                            popupImage(aC, az, ay)
                        }
                        if (aA) {
                            m["" + aC + ""] = true
                        }
                    }
                }
            }
        };
    var ag = function () {
            popupShowURL("/ajax/globalinfo.php", "Participate in Global Auctions", 550, false, "", true)
        };
    this.getClockText = function () {
        var ay = "";
        if (!$("#clockImage") || clockTime == 0) {
            return ""
        }
        if (p >= h) {
            ay = "Each bid resets the clock to 10 seconds."
        } else {
            if (p >= F) {
                ay = "Each bid resets the clock to 15 seconds."
            } else {
                ay = "Once the clock is under 20 seconds, each bid will reset the clock to 20 seconds."
            }
        }
        return ay
    };
    $(document).ready(function () {
        if (pageID == 2) {
            $("#bhb_1").mouseover(function () {
                af("bhb_1")
            });
            $("#bhb_1").mouseleave(function () {
                N("bhb_1")
            });
            $("#bhb_2").mouseover(function () {
                af("bhb_2")
            });
            $("#bhb_2").mouseleave(function () {
                N("bhb_2")
            });
            $("#bhb_3").mouseover(function () {
                af("bhb_3")
            });
            $("#bhb_3").mouseleave(function () {
                N("bhb_3")
            });
            $("#bhb_4").mouseover(function () {
                af("bhb_4")
            });
            $("#bhb_4").mouseleave(function () {
                N("bhb_4")
            });
            $("#bhb_5").mouseover(function () {
                af("bhb_5")
            });
            $("#bhb_5").mouseleave(function () {
                N("bhb_5")
            });
            $("#bhb_6").mouseover(function () {
                af("bhb_6")
            });
            $("#bhb_6").mouseleave(function () {
                N("bhb_6")
            });
            $("#bhb_7").mouseover(function () {
                af("bhb_7")
            });
            $("#bhb_7").mouseleave(function () {
                N("bhb_7")
            });
            $("#bhb_8").mouseover(function () {
                af("bhb_8")
            });
            $("#bhb_8").mouseleave(function () {
                N("bhb_8")
            });
            $("#bhb_9").mouseover(function () {
                af("bhb_9")
            });
            $("#bhb_9").mouseleave(function () {
                N("bhb_9")
            });
            $("#prof-popup-content").mouseover(function () {
                c()
            });
            $("#prof-popup-content").mouseleave(function () {
                N(U)
            })
        }
    });
    this.updateConnectionSpeed = function () {
        if (Math.floor(Math.random() * 5) != 1) {
            return
        }
        var ay = 0;
        if (aa.length > 0) {
            $.each(aa, function (aA, aB) {
                ay += aB
            });
            ay = ay / aa.length;
            ay.toFixed(0)
        }
        try {
            if (qBarEnabled) {
                QBar.updateConnectionSpeed(ay)
            }
        } catch (az) {}
    };

    function af(az, ay) {
        var aB = $("#" + az).html();
        if (aB == "" || aB == "&nbsp;" || aB == "No bidders yet!" || aB == "No Bids Yet!" || aB == "N/A") {
            return
        }
        U = az;
        if (!ay) {
            b = parseInt(az.replace("bhb_", ""))
        } else {
            b = 0
        }
        E = "";
        if (!Z[aB]) {
            $("#profile-left").html();
            $("#profile-right").html('<p><br/><img src="http://s1.quibidscdn.com/images/qbar/ajax-loader.gif" /><br/><br/>&nbsp;</p>');
            var aA = "/ajax/profiles.php?username=" + aB;
            if (s) {
                aA += "&auctionid=" + s
            }
            $.ajax({
                url: aA,
                cache: true,
                success: function (aC) {
                    if (aC.profile) {
                        Z[aB] = aC.profile;
                        z(Z[aB], az, ay)
                    }
                }
            })
        } else {
            z(Z[aB], az, ay)
        }
        $("#profile-popup").clearQueue();
        i(az, ay);
        $("#profile-popup").show();
        f = (new Date()).getTime()
    }
    function i(aA, az) {
        var aB = $("#" + aA).offset().left - ($("#profile-popup").width() / 2);
        if (az) {
            aB += 100
        } else {
            aB += 70
        }
        var ay = $("#" + aA).offset().top - $("#profile-popup").height();
        if (az) {
            ay -= 10
        } else {
            ay += 1
        }
        $("#profile-popup").css({
            top: ay,
            left: aB
        })
    }
    function N(ay) {
        if (ay != U) {
            return
        }
        E = ay;
        setTimeout("Auctions.hideProfileActually('" + ay + "');", 500)
    }
    this.hideProfileActually = function (ay) {
        if (E != ay) {
            return
        }
        b = -1;
        $("#profile-popup").clearQueue();
        $("#profile-popup").hide()
    };

    function ak(az) {
        if (pageID == 2 && b > 0) {
            var ay = b;
            b += az;
            if (b > 9) {
                b = 0;
                showConsole(b, "hiding");
                E = U;
                Auctions.hideProfileActually(U)
            } else {
                showConsole(b, "moving");
                i("bhb_" + b)
            }
        }
    }
    function c() {
        E = ""
    }
    function z(aD, aE, aC) {
        if (!aD.username) {
            return
        }
        var aB = "";
        aB += '<img src="http://s1.quibidscdn.com/n1/avatards/' + aD.avatar + '.png" />';
        aB += '<p class="userNameTitle">' + aD.username + "</p>";
        if (aD.joined) {
            aB += "<p>Member Since:</p>";
            aB += "<p>" + aD.joined + "</p>"
        }
        $("#profile-left").html(aB);
        var az = "";
        if (aD.biddingOn) {
            az += "<p><strong>Bidding On</strong></p>";
            az += "<p>" + aD.biddingOn + "</p>"
        }
        if (aD.location) {
            az += "<p><strong>Location</strong></p>";
            az += "<p>" + aD.location + "</p>"
        }
        if (aD.win) {
            az += "<p><strong>Latest Win</strong></p>";
            az += "<p>" + aD.win + "</p>"
        }
        if (aD.badges && aD.badges.length > 0) {
            az += "<p><strong>Latest Achievements</strong></p>";
            az += "<p>";
            for (id in aD.badges) {
                var aA = aD.badges[id];
                if (aA.image && aA.title) {
                    az += ' <img src="' + aA.image + '" title="' + aA.title + '" width="30" height="30" />'
                }
            }
            az += "</p>"
        }
        $("#profile-right").html(az);
        var ay = $("#" + aE).offset().top - $("#profile-popup").height();
        if (aC) {
            ay -= 10
        } else {
            ay += -1
        }
        $("#profile-popup").css({
            top: ay
        })
    }
    var v = function (ay, az) {
            if (az && ay != null && $("#" + ay)) {
                $("#" + ay).css("outline", "1px solid red")
            }
            if (!az && ay != null && $("#" + ay)) {
                $("#" + ay).css("outline", "")
            }
        };
    var r = function (ay) {
            newId = new String(ay);
            for (x = at.length - 1;
            x >= 0; x--) {
                newId = newId.ReplaceAll(x, at.charAt(x))
            }
            return newId
        };
    var j = function () {
            var ay = readCookie("PHPSESSID");
            var az = "";
            for (x = 0; x < ay.length; x++) {
                var aA = ay.charAt(x);
                var aB = aA.charCodeAt(0);
                if ((aB < 65) || (aB > 122) || ((aB > 90) && (aB < 97))) {
                    continue
                }
                if (az.indexOf(aA) == -1) {
                    az += aA
                }
            }
            if (az.length < 50) {
                var aC = "QwErTyUiOpAsDfGhJkLzXcVbNmqWeRtYuIoPaSdFgHjKlZxCvBnM";
                for (x = 0; x < aC.length; x++) {
                    var aA = aC.charAt(x);
                    if (az.indexOf(aA) == -1) {
                        az += aA
                    }
                    if (az.length >= 50) {
                        break
                    }
                }
            }
            return az
        }
}
function buyitnowCountdown(a) {
    buyitnowTime = ((new Date()).getTime() / 1000) + (a);
    timerBuyItNowID = $.timer(1000, buyitnowTick)
}
function buyitnowTick() {
    if ($("#buyitnowTimeLeft")) {
        var c = buyitnowTime - ((new Date()).getTime() / 1000);
        if (c < 0) {
            location.reload(true)
        }
        var a = "";
        if (c < 0) {
            a = "00:00:00"
        } else {
            var d = parseInt(c / 86400);
            if (d > 0) {
                hours = parseInt((c - d * 86400) / 3600);
                a += d + " day" + ((d > 1) ? "s" : "") + ", ";
                a += hours + " hour" + ((hours > 1) ? "s" : "")
            } else {
                var b = 0;
                b = parseInt(c / 3600);
                a += ((b > 9) ? "" : "0") + b + ":";
                b = parseInt((c / 60) % 60);
                a += ((b > 9) ? "" : "0") + b + ":";
                b = parseInt(c % 60);
                a += ((b > 9) ? "" : "0") + b
            }
        }
        $("#buyitnowTimeLeft").html(a)
    }
}
function updateGeoMap(a) {
    if (mapReady) {
        if (pending != "") {
            quimap.updateGeoMap(pending);
            pending = ""
        }
        quimap.updateGeoMap(a)
    } else {
        if (pending != "") {
            pending += "," + a
        } else {
            pending = a
        }
    }
}
function commandGeoMap(a) {
    if (mapReady) {
        switch (a) {
        case "enableMap":
            mapEnabled = a;
            $("#map-max").show("fast");
            $("#map-min").show("fast");
            $("#map-display-hide").removeClass("selected");
            $("#map-display-show").addClass("selected");
            setMapCookies();
            if (mapSize != "normalSize" && mapSize != "fullSize") {
                mapSize = "normalSize"
            }
            commandGeoMap(mapSize);
            break;
        case "disableMap":
            mapEnabled = a;
            $("#map-display-show").removeClass("selected");
            $("#map-display-hide").addClass("selected");
            $("#q-map").css("height", "66px");
            $("#map-max").hide("fast");
            $("#map-min").hide("fast");
            setMapCookies();
            break;
        case "normalSize":
            mapSize = a;
            $("#q-map").css("height", "167px");
            quimap.height = "100px";
            $("#map-max").removeClass("selected");
            $("#map-min").addClass("selected");
            setMapCookies();
            break;
        case "fullSize":
            mapSize = a;
            $("#q-map").css("height", "267px");
            quimap.height = "200px";
            $("#map-max").addClass("selected");
            $("#map-min").removeClass("selected");
            setMapCookies();
            break
        }
        quimap.commandGeoMap(a)
    }
}
function fromMap(a) {
    if (a.indexOf("created map successfully") >= 0) {
        mapReady = true;
        quimap = swfobject.getObjectById("quimap");
        getMapCookies();
        $("#map-max").hide("fast");
        $("#map-min").hide("fast");
        commandGeoMap(mapSize);
        commandGeoMap(mapEnabled);
        return
    }
    if (mapReady) {}
}
function setMapCookies() {
    createCookie("qmapEnabled", mapEnabled, 180);
    createCookie("qmapSize", mapSize, 180)
}
function getMapCookies() {
    mapEnabled = readCookie("qmapEnabled");
    mapSize = readCookie("qmapSize")
}
function BuyItNowPopup(c, b) {
    var a = "/auction_buyitnow.php?id=" + c;
    if (b) {
        a += "&overbid=1"
    }
    popupDiv(a, 620, 465)
}
function switchImage(a) {
    try {
        document.getElementById("prodimg").style.backgroundImage = "url(" + a + ")"
    } catch (b) {}
}
function showConsole(b, a, c) {
    if (debugging && window.console && window.console.firebug) {
        if (c && debuggingLevel < c) {
            return
        }
        if (a) {
            console.log(b, a)
        } else {
            console.log(b)
        }
    }
}
String.prototype.ReplaceAll = function (c, d) {
    var a = this;
    var b = a.indexOf(c);
    while (b != -1) {
        a = a.replace(c, d);
        b = a.indexOf(c)
    }
    return a
};

function killAuctions() {
    if (Auctions) {
        Auctions.killAuctions()
    }
}
Auctions = new Class_Auctions();
$(document).ready(function () {
    Auctions.initializeInterval()
});
auctionsEnabled = true;

function Class_Carousel() {
    var a = 5000;
    var g = 5000;
    var f = true;
    var e = "";
    var d = false;

    function c(i) {
        $("#slider-nav li.active").removeClass("active");
        $(i).addClass("active");
        $("#slider .content").hide();
        var h = $(i).find("a").attr("href");
        $(h).fadeIn();
        return false
    }
    function b() {
        if (f) {
            var h = setTimeout(function () {
                if (!f) {
                    clearTimeout(h);
                    return
                } else {
                    var i = $("#slider-nav li.active");
                    if (i.length == 0 || $("#slider-nav li.active").attr("id") == $("#slider-nav li:last").attr("id")) {
                        if (!d) {
                            g = $("#slider-nav li:first").attr("time");
                            c($("#slider-nav li:first"))
                        }
                    } else {
                        if (!d) {
                            g = $("#slider-nav li.active").next().attr("time");
                            c($("#slider-nav li.active").next())
                        }
                    }
                    if (g < 500) {
                        g = a
                    }
                    b()
                }
            }, g)
        }
    }
    $(document).ready(function () {
        $("#slider .content").hide();
        f = true;
        if (location.hash != "") {
            var h = "#" + location.hash.split("#")[1];
            $(location.hash).show();
            $("#slider-nav li:has(a[href=" + h + "])").addClass("active").show()
        } else {
            $("#slider-nav li:first").addClass("active").show();
            $("#slider .content:first").show()
        }
        g = $("#slider-nav li.active").attr("time");
        b();
        $("#slider-nav li").click(function () {
            return false
        });
        $("#slider").hover(function () {
            d = true
        }, function () {
            d = false
        });
        $("#slider-nav li").hover(function () {
            d = true;
            c(this)
        }, function () {
            d = false
        })
    })
};
