// UBC+
#include <iostream>
#include <set>
#include <vector>
using namespace std;
typedef long long ll;
typedef multiset<ll> si;
typedef vector<ll> vi;
typedef vector<vi> vvi;
typedef vector<si> vsi;


void max_min(vvi& ch, vi& sal, vi& mmax, vi& mmin, ll ind) {
	ll temp_max = sal[ind];
	ll temp_min = sal[ind];
	for (ll i = 0; i < ch[ind].size(); ++i) {
		ll child = ch[ind][i];
		if (mmax[child] == -1) {
			max_min(ch, sal, mmax, mmin, child);
		}
		temp_max = max(temp_max, mmax[child]);
		temp_min = min(temp_min, mmin[child]);
	}
	mmax[ind] = temp_max;
	mmin[ind] = temp_min;
}

int main() {
	ll T; cin >> T;
	for (; T > 0; --T) {
		ll N; cin >> N;

		// 1 indexed
		vi parent(N+1);
		vi mmax(N+1, -1);
		vi mmin(N+1, -1);
		vsi chdn(N+1);
		vvi ch(N+1);

		for (ll i = 2; i <= N; ++i) {
			cin >> parent[i];
			ch[parent[i]].push_back(i);
		}

		vi salary(N+1);
		for (ll i = 1; i <= N; ++i)
			cin >> salary[i];

		max_min(ch, salary, mmax, mmin, 1);
		// for (ll i = 0; i < mmax.size(); ++i)
			// cout << mmin[i] << ' ';
		// cout << endl;
		
		for (ll i = 1; i <= N; ++i) {
			for (ll j = 0; j < ch[i].size(); ++j) {
				ll child = ch[i][j]; // jth children of i
				chdn[i].insert(mmin[child]);
			}
		}

		vi raise(N+1, 0);
		ll Q; cin >> Q;
		char qry;

		for (ll i = 0; i < Q; ++i) {
			cin >> qry;	
			ll id, num, p, old_min, it;
			switch (qry) {
				case 'R': 
					// update max and min
					cin >> id >> num;
					old_min = mmin[id] + raise[id];
					raise[id] += num;

					// update parent max/min
					it = id;
					while (it != 1) {
						p = parent[it];
						// cout << it << ' ' << p << endl;
						mmax[p] = max(mmax[p], mmax[it] + raise[it]);
						// save the old_min
						// cout << "erase: " << old_min << endl;
						// cout << "insert: " << mmin[it] << ' ' << raise[it] << endl;
						chdn[p].erase(chdn[p].find(old_min));
						chdn[p].insert(mmin[it] + raise[it]);
						// update the min
						old_min = mmin[p] + raise[p];
						mmin[p] = *chdn[p].begin();
						// cout << "New min: " << mmin[p] << endl;
						// cout << "it: " << it << ' ' << mmin[it] << ' ' << mmax[it] << endl;
						it = p;
					}
					break;

				case 'Q':
					cin >> id;
					cout << mmax[id] - mmin[id] << endl;
					break;
			}
		}
	}
	return 0;
}
